package com.dvase.dvase_v2_bluetooth;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import android.Manifest;
import android.app.Activity;
import android.app.AlertDialog;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.bluetooth.BluetoothSocket;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.content.pm.ResolveInfo;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Environment;
import android.os.Handler;
import android.os.Looper;
import android.provider.MediaStore;
import android.provider.Settings;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Random;
import java.util.Set;
import java.util.Timer;
import java.util.TimerTask;
import java.util.UUID;

import app.akexorcist.bluetotohspp.library.BluetoothSPP;
import app.akexorcist.bluetotohspp.library.BluetoothState;
import app.akexorcist.bluetotohspp.library.DeviceList;

public class MainActivity extends AppCompatActivity {
    private static final String TAG = "kyuri";
    private static final int MY_PERMISSIONS_REQUEST_CAMERA = 1111;
    private final int CAMERA_REQUEST_CODE = 1;

    private static final int REQUEST_ENABLE_BT = 10; // 블루투스 활성화 상태

    private BluetoothAdapter bluetoothAdapter; // 블루투스 어댑터
    private Set<BluetoothDevice> devices; // 블루투스 디바이스 데이터 셋
    private BluetoothDevice bluetoothDevice; // 블루투스 디바이스
    private BluetoothSocket bluetoothSocket = null; // 블루투스 소켓
    private OutputStream outputStream = null; // 블루투스에 데이터를 출력하기 위한 출력 스트림
    private InputStream inputStream = null; // 블루투스에 데이터를 입력하기 위한 입력 스트림
    private Thread workerThread = null; // 문자열 수신에 사용되는 쓰레드
    private int readBufferPosition; // 버퍼 내 문자 저장 위치
    private int pariedDeviceCount;

    private AlertDialog alert;

    private EditText txtView;

    Button btnCamera;
    ImageView img;

    private BluetoothSPP bt;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtView = findViewById(R.id.txtView);
//        bt = new BluetoothSPP(this); //Initializing
//
//        btReady();
//        btConnect();

        checkPermission();

        setup();

//        bt.setOnDataReceivedListener(new BluetoothSPP.OnDataReceivedListener() { //데이터 수신
//            public void onDataReceived(byte[] data, String message) {
//                Log.d(TAG, "message : " + message );
//
//                Toast.makeText(MainActivity.this, message, Toast.LENGTH_SHORT).show();
//            }
//        });
        // 블루투스 활성화하기

        bluetoothAdapter = BluetoothAdapter.getDefaultAdapter(); // 블루투스 어댑터를 디폴트 어댑터로 설정

        if(bluetoothAdapter == null) { // 디바이스가 블루투스를 지원하지 않을 때
            // 여기에 처리 할 코드를 작성하세요.
        }
        else { // 디바이스가 블루투스를 지원 할 때
            if(bluetoothAdapter.isEnabled()) { // 블루투스가 활성화 상태 (기기에 블루투스가 켜져있음)
                selectBluetoothDevice(); // 블루투스 디바이스 선택 함수 호출
            }
            else { // 블루투스가 비 활성화 상태 (기기에 블루투스가 꺼져있음)
                // 블루투스를 활성화 하기 위한 다이얼로그 출력
                Intent intent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
                // 선택한 값이 onActivityResult 함수에서 콜백된다.
                startActivityForResult(intent, REQUEST_ENABLE_BT);
            }
        }
    }

    public void send(View view){
        String txt = txtView.getText().toString();
        sendData(txt, false);

        connectDevice(deviceName);
    }
    void sendData(String text, boolean isInt) {
        // 문자열에 개행문자("\n")를 추가해줍니다.
        int txt = 0;
        if ( isInt ) txt = Integer.parseInt( text );

        try{
            // 데이터 송신
            if ( isInt) outputStream.write(txt);
            else outputStream.write(text.getBytes());
        }catch(Exception e) {
            e.printStackTrace();
        }
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        switch (requestCode) {
            case REQUEST_ENABLE_BT :
                if(requestCode == RESULT_OK) { // '사용'을 눌렀을 때
                    selectBluetoothDevice(); // 블루투스 디바이스 선택 함수 호출
                }
                else { // '취소'를 눌렀을 때
                    // 여기에 처리 할 코드를 작성하세요.
                }
            break;
        }

        if(requestCode==CAMERA_REQUEST_CODE){

            Bundle bundle = data.getExtras();

            Bitmap bitmap = (Bitmap) bundle.get("data");
            img.setImageBitmap(bitmap);

            String destFolder = Environment.getExternalStorageDirectory().toString();
            String date = new SimpleDateFormat("yyyy_MM_dd_hh_mm_ss").format(new Date());

            try {
                FileOutputStream out = new FileOutputStream(destFolder + "/video/" + date + ".jpg");
                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, out);
                Toast.makeText(this, "사진 자동 업로드", Toast.LENGTH_SHORT).show();
            } catch (FileNotFoundException e) {
                e.printStackTrace();
                Toast.makeText(this, "폴더를 찾지 못해 업로드하지 못했습니다.", Toast.LENGTH_SHORT).show();
                return;
            } catch (IOException e) {
                e.printStackTrace();
                Toast.makeText(this, "이미지를 불러오지 못해 업로드하지 못했습니다.", Toast.LENGTH_SHORT).show();
                return;
            }
        }
        else  if (requestCode == BluetoothState.REQUEST_CONNECT_DEVICE) {
            if (resultCode == Activity.RESULT_OK)
                bt.connect(data);
        } else if (requestCode == BluetoothState.REQUEST_ENABLE_BT) {
            if (resultCode == Activity.RESULT_OK) {
                bt.setupService();
                bt.startService(BluetoothState.DEVICE_OTHER);
                setup();
            } else {
                Toast.makeText(getApplicationContext()
                        , "Bluetooth was not enabled."
                        , Toast.LENGTH_SHORT).show();
                finish();
            }
        }
    }
    public void selectBluetoothDevice() {
        // 이미 페어링 되어있는 블루투스 기기를 찾습니다.
        devices = bluetoothAdapter.getBondedDevices();
        // 페어링 된 디바이스의 크기를 저장
        pariedDeviceCount = devices.size();
        // 페어링 되어있는 장치가 없는 경우
        if(pariedDeviceCount == 0) {
            // 페어링을 하기위한 함수 호출
        }
        // 페어링 되어있는 장치가 있는 경우
        else {
            // 디바이스를 선택하기 위한 다이얼로그 생성
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            builder.setTitle("페어링 되어있는 블루투스 디바이스 목록");

            // 페어링 된 각각의 디바이스의 이름과 주소를 저장
            List<String> list = new ArrayList<>();

            // 모든 디바이스의 이름을 리스트에 추가
            for(BluetoothDevice bluetoothDevice : devices) {
                list.add(bluetoothDevice.getName());
            }
            list.add("취소");

            // List를 CharSequence 배열로 변경

            final CharSequence[] charSequences = list.toArray(new CharSequence[list.size()]);
            list.toArray(new CharSequence[list.size()]);

            // 해당 아이템을 눌렀을 때 호출 되는 이벤트 리스너
            builder.setItems(charSequences, new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    // 해당 디바이스와 연결하는 함수 호출
                    deviceName = charSequences[which].toString();
                    connectDevice(deviceName);
                }
            });
            // 뒤로가기 버튼 누를 때 창이 안닫히도록 설정
            builder.setCancelable(false);
            // 다이얼로그 생성
            AlertDialog alertDialog = builder.create();
            alertDialog.show();
        }
    }
    String deviceName = "";
    public void connectDevice(String deviceName) {
        // 페어링 된 디바이스들을 모두 탐색
        for(BluetoothDevice tempDevice : devices) {
            // 사용자가 선택한 이름과 같은 디바이스로 설정하고 반복문 종료
            if(deviceName.equals(tempDevice.getName())) {
                bluetoothDevice = tempDevice;
                break;
            }
        }

        // UUID 생성
        UUID uuid = java.util.UUID.fromString("00001101-0000-1000-8000-00805f9b34fb");
        // Rfcomm 채널을 통해 블루투스 디바이스와 통신하는 소켓 생성
        try {
            bluetoothSocket = bluetoothDevice.createRfcommSocketToServiceRecord(uuid);
            bluetoothSocket.connect();
            // 데이터 송,수신 스트림을 얻어옵니다.
            outputStream = bluetoothSocket.getOutputStream();
            inputStream = bluetoothSocket.getInputStream();
            // 데이터 수신 함수 호출

            sendData("c", false);

            receiveData();
        } catch (IOException e) {
            e.printStackTrace();
        }

    }
    int nowByte = 0;
    public void receiveData() {
        final Handler handler = new Handler();
        // 데이터를 수신하기 위한 버퍼를 생성
        readBufferPosition = 0;
        // 데이터를 수신하기 위한 쓰레드 생성
        workerThread = new Thread(new Runnable() {

            @Override
            public void run() {
                while(!Thread.currentThread().isInterrupted()) {
                    try {
                        // 데이터를 수신했는지 확인합니다.
                        int byteAvailable = inputStream.available();

                        // 데이터가 수신 된 경우
                        if(byteAvailable > 0) {
                            if ( nowByte != byteAvailable ) {
                                Handler mHandler = new Handler(Looper.getMainLooper());
                                mHandler.postDelayed(new Runnable() {
                                    @Override
                                    public void run() {
                                        btControl();
                                    }
                                }, 500);
                                nowByte = byteAvailable;
                            }
                        }
                    } catch (IOException e) {
                        e.printStackTrace();
                    }
                    try {
                        Thread.sleep(1000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        });
        workerThread.start();
    }

    public void setup(){
        btnCamera = (Button)findViewById(R.id.btnCamera);
        img = (ImageView)findViewById(R.id.img);

        btnCamera.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                if(IsCameraAvailable()){
                    Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);

                    startActivityForResult(intent, CAMERA_REQUEST_CODE);
                }
            }
        });
    }

    private void btControl(){
            AlertDialog.Builder builder = new AlertDialog.Builder(this);

            builder.setTitle("습도 알림")
                    .setMessage("화분의 습도가 일정 이하로 떨어졌습니다. 물을 줄까요?")
                    .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                            sendData("a", false);

//                            connectDevice(deviceName);
                        }
                    })
                    .setNegativeButton("취소", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {
                        }
                    });

            this.alert = builder.create();
            this.alert.show();
    }

    //카메라 유무
    public boolean IsCameraAvailable(){
        PackageManager packageManager = getPackageManager();
        Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        List<ResolveInfo> list = packageManager.queryIntentActivities(intent, PackageManager.MATCH_DEFAULT_ONLY);
        return list.size() > 0;
    }

    public void checkPermission(){
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.CAMERA)!= PackageManager.PERMISSION_GRANTED ) {
            if ((ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.WRITE_EXTERNAL_STORAGE)) ||
                    (ActivityCompat.shouldShowRequestPermissionRationale(this, Manifest.permission.CAMERA))) {
                new AlertDialog.Builder(this)
                        .setTitle("알림")
                        .setMessage("저장소 권한이 거부되었습니다. 사용을 원하시면 설정에서 해당 권한을 직접 허용하셔야 합니다.")
                        .setNeutralButton("설정", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                Intent intent = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS);
                                intent.setData(Uri.parse("package:" + getPackageName()));
                                startActivity(intent);
                            }
                        })
                        .setPositiveButton("확인", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {
                                finish();
                            }
                        })
                        .create()
                        .show();
            } else {
                ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.CAMERA, Manifest.permission.WRITE_EXTERNAL_STORAGE}, MY_PERMISSIONS_REQUEST_CAMERA);
                Toast.makeText(this,"권한 승인이 필요합니다.",Toast.LENGTH_LONG).show();
            }
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, String permissions[], int[] grantResults) {
        switch (requestCode) {
            case MY_PERMISSIONS_REQUEST_CAMERA:
                for (int i = 0; i < grantResults.length; i++) {
                    // grantResults[] : 허용된 권한은 0, 거부한 권한은 -1
                    if (grantResults[i] < 0) {
//                        Toast.makeText(MainActivity.this, "해당 권한을 활성화 하셔야 합니다.", Toast.LENGTH_SHORT).show();
                        return;
                    }
                    else{
                        Toast.makeText( MainActivity.this, "권한이 승인되었습니다.", Toast.LENGTH_SHORT ).show();
                    }
                }
                break;
        }
    }
}
