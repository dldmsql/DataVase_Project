package com.dvase.dvase;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import android.Manifest;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.bluetooth.BluetoothSocket;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.content.pm.ResolveInfo;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Matrix;
import android.media.ExifInterface;
import android.net.Uri;
import android.os.Environment;
import android.os.Handler;
import android.os.Looper;
import android.provider.MediaStore;
import android.provider.Settings;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.core.content.FileProvider;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URI;
import java.net.URISyntaxException;
import java.net.URL;
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
import cz.msebera.android.httpclient.HttpResponse;
import cz.msebera.android.httpclient.client.ClientProtocolException;
import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.client.entity.UrlEncodedFormEntity;
import cz.msebera.android.httpclient.client.methods.HttpPost;
import cz.msebera.android.httpclient.message.BasicNameValuePair;

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

    private int serverResponseCode = 0;
    final static int TAKE_PICTURE = 1;
    String mCurrentPhotoPath;
    static final int REQUEST_TAKE_PHOTO = 1;

    String upLoadServerUri;

    private AlertDialog alert;
    private ProgressDialog startProgress;

    ImageButton cameraBtn;
    ListView listView;

    private ListViewAdapter adapter;

    private BluetoothSPP bt;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        checkPermission();

        setup();

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
    private void startProgress(){
        this.startProgress = new ProgressDialog(this);
        this.startProgress.setProgressStyle( ProgressDialog.STYLE_SPINNER);
        this.startProgress.setMessage( "잠시만 기다려주세요." );
        this.startProgress.show();
    }
    void sendData(String text, boolean isInt) {
        // 문자열에 개행문자("\n")를 추가해줍니다.
        int txt = 0;
        if ( isInt ) txt = Integer.parseInt( text );

        Log.d(TAG, "데이터보냄");

        try{
            // 데이터 송신
            if ( isInt) outputStream.write(txt);
            else outputStream.write(text.getBytes());

//            outputStream.flush();
        }catch(Exception e) {
            e.printStackTrace();
        }
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        try {
            switch (requestCode) {
                case REQUEST_ENABLE_BT:
                    if (requestCode == RESULT_OK) { // '사용'을 눌렀을 때
                        selectBluetoothDevice(); // 블루투스 디바이스 선택 함수 호출
                    } else { // '취소'를 눌렀을 때
                        // 여기에 처리 할 코드를 작성하세요.
                    }
                    break;

                case BluetoothState.REQUEST_CONNECT_DEVICE:
                    if (resultCode == Activity.RESULT_OK)
                        bt.connect(data);
                    break;

                case BluetoothState.REQUEST_ENABLE_BT:
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
                    break;

                case REQUEST_TAKE_PHOTO:
                    if (resultCode == RESULT_OK) {
                        File file = new File(mCurrentPhotoPath);
                        Bitmap bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), Uri.fromFile(file));
                        if (bitmap != null) {
                            ExifInterface ei = new ExifInterface(mCurrentPhotoPath);
                            int orientation = ei.getAttributeInt(ExifInterface.TAG_ORIENTATION,
                                    ExifInterface.ORIENTATION_UNDEFINED);

                            Bitmap rotatedBitmap = null;
                            switch (orientation) {

                                case ExifInterface.ORIENTATION_ROTATE_90:
                                    rotatedBitmap = rotateImage(bitmap, 90);
                                    break;

                                case ExifInterface.ORIENTATION_ROTATE_180:
                                    rotatedBitmap = rotateImage(bitmap, 180);
                                    break;

                                case ExifInterface.ORIENTATION_ROTATE_270:
                                    rotatedBitmap = rotateImage(bitmap, 270);
                                    break;

                                case ExifInterface.ORIENTATION_NORMAL:
                                default:
                                    rotatedBitmap = bitmap;
                            }

//                            imageView.setImageBitmap(rotatedBitmap);

                            uploadProfilPic();

                            Log.d(TAG, "mCurrentPhotoPath : " + mCurrentPhotoPath);
                        }
                    }
                    break;
            }
        }
        catch (Exception e ){
            e.printStackTrace();
        }

//        if(requestCode==CAMERA_REQUEST_CODE){
//
//            Bundle bundle = data.getExtras();
//            bundle.get("data");
//
//            Bitmap bitmap = (Bitmap) bundle.get("data");
//            Bitmap compressBitmap = compressBitmap(bitmap);
//            imageView.setImageBitmap(compressBitmap);
//
//            String destFolder = Environment.getExternalStorageDirectory().toString();
//            String date = new SimpleDateFormat("yyyy_MM_dd_hh_mm_ss").format(new Date());
//
//            try {
//                FileOutputStream out = new FileOutputStream(destFolder + "/video/" + date + ".jpg");
////                bitmap.compress(Bitmap.CompressFormat.JPEG, 100, out);
//                compressBitmap.compress(Bitmap.CompressFormat.JPEG, 100, out);
//                Toast.makeText(this, "사진 자동 업로드", Toast.LENGTH_SHORT).show();
//            } catch (FileNotFoundException e) {
//                e.printStackTrace();
//                Toast.makeText(this, "폴더를 찾지 못해 업로드하지 못했습니다.", Toast.LENGTH_SHORT).show();
//                return;
//            } catch (IOException e) {
//                e.printStackTrace();
//                Toast.makeText(this, "이미지를 불러오지 못해 업로드하지 못했습니다.", Toast.LENGTH_SHORT).show();
//                return;
//            }
//        }
    }
    public void setup(){
        cameraBtn = findViewById(R.id.camera_button);

//        uploadButton = findViewById(R.id.upload);
//        uploadButton.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                uploadProfilPic();
//            }
//        });

        cameraBtn.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                dispatchTakePictureIntent();
            }
        });

        listView = findViewById(R.id.listView);
        adapter = new ListViewAdapter();

//        upLoadServerUri = "http://15.164.251.97/dvase/uploadFileManaging";
        upLoadServerUri = "http://15.164.251.97/dvaseFolder/uploadFile.php";
    }
    private void setList(){
        ArrayList<VOGarden> voGardens = null;

        adapter.removeAll();
        for ( int i = 0; i < voGardens.size(); i++ ){
            adapter.addVO( voGardens.get(i) );
        }

        listView.setAdapter(adapter);
    }
    String result = "";
    private void getInfo(){
        Thread thread = new Thread() {
            @Override
            public void run() {
                HttpClient httpClient = SessionControl.getHttpClient();
                String urlString = "http://15.164.251.97/dvase/identifyPlant";
                try {
                    URI url = new URI(urlString);
                    HttpPost httpPost = new HttpPost();
                    httpPost.setURI(url);

                    List<BasicNameValuePair> nameValuePairs = new ArrayList<BasicNameValuePair>(2);
                    httpPost.setEntity(new UrlEncodedFormEntity(nameValuePairs, "UTF-8"));
                    // httpClient.execute(httpPost);
                    HttpResponse response = httpClient.execute(httpPost);
                    BufferedReader bufreader = new BufferedReader(new InputStreamReader(response.getEntity().getContent(), "utf-8"));
                    String line = null;
                    result = "";
                    while ((line = bufreader.readLine()) != null) {
                        result += line;
                    }
                } catch (URISyntaxException e) {
                    Log.e(TAG, e.getLocalizedMessage());
                    e.printStackTrace();
                } catch (ClientProtocolException e) {
                    Log.e(TAG, e.getLocalizedMessage());
                    e.printStackTrace();
                } catch (IOException e) {
                    Log.e(TAG, e.getLocalizedMessage());
                    e.printStackTrace();
                }
            }
        };
        thread.start();
    }
    private void setInfo(){
        if ( result!= null ) {
            try {
                JSONObject jobject = new JSONObject(result);
                String return_value = jobject.getString("return");
                if (return_value.equals("false")) {
                    String msg = jobject.getString("msg");
                    Toast.makeText(getApplicationContext(), msg, Toast.LENGTH_LONG).show();
                    result = "";
                } else if (return_value.equals("true")) {
                    Log.d(TAG, "result : " + result );
                    Log.d(TAG, "true");
                    String plant_ID = jobject.getString("ID");
                    String plant_name = jobject.getString("name");


                }
                setList();
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
        else Log.d(TAG, "result is null");

        startProgress.hide();
    }
    private void uploadProfilPic() {
        startProgress();
        new Thread(new Runnable() {
            public void run() {
                Log.d(TAG, "imagePath : " + mCurrentPhotoPath);
                uploadFile(mCurrentPhotoPath);
            }
        }).start();
    }
    private File createImageFile() throws IOException {
        // Create an image file name
        String timeStamp = new SimpleDateFormat("yyyyMMdd_HHmmss").format(new Date());
        String imageFileName = "JPEG_" + timeStamp + "_";
        File storageDir = getExternalFilesDir(Environment.DIRECTORY_PICTURES);
        File image = File.createTempFile(
                imageFileName,  /* prefix */
                ".jpg",         /* suffix */
                storageDir      /* directory */
        );

        mCurrentPhotoPath = image.getAbsolutePath();
        return image;
    }

    private void dispatchTakePictureIntent() {
        Intent takePictureIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        // Ensure that there's a camera activity to handle thgointent
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            // Create the File where the photo should go
            File photoFile = null;
            try {
                photoFile = createImageFile();
            } catch (IOException ex) {
                // Error occurred while creating the File
            }
            // Continue only if the File was successfully created
            if (photoFile != null) {
                Uri photoURI = FileProvider.getUriForFile(this,
                        "com.roopre.cameratutorial.fileprovider",
                        photoFile);
                takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
                startActivityForResult(takePictureIntent, REQUEST_TAKE_PHOTO);
            }
        }
    }

    public int uploadFile(String sourceFileUri) {
        String fileName = sourceFileUri;
        HttpURLConnection conn = null;
        DataOutputStream dos = null;
        String lineEnd = "\r\n";
        String twoHyphens = "--";
        String boundary = "*****";
        int bytesRead, bytesAvailable, bufferSize;
        byte[] buffer;
        int maxBufferSize = 1 * 1024 * 1024;
        File sourceFile = new File(sourceFileUri);

        if (!sourceFile.isFile()) {
            return 0;
        } else {
            try {
                // open a URL connection to the Servlet
                FileInputStream fileInputStream = new FileInputStream(sourceFile);
                URL url = new URL(upLoadServerUri);

                Log.d(TAG, "CONNECT?");
                // Open a HTTP  connection to  the URL
                conn = (HttpURLConnection) url.openConnection();
                conn.setDoInput(true); // Allow Inputs
                conn.setDoOutput(true); // Allow Outputs
                conn.setUseCaches(false); // Don't use a Cached Copy
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Connection", "Keep-Alive");
                conn.setRequestProperty("ENCTYPE", "multipart/form-data");
                conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
                conn.setRequestProperty("uploaded_file", fileName);

                dos = new DataOutputStream(conn.getOutputStream());

                dos.writeBytes(twoHyphens + boundary + lineEnd);
                dos.writeBytes("Content-Disposition: form-data; name=\"uploaded_file\";filename=\"" + fileName + "\"" + lineEnd);

                dos.writeBytes(lineEnd);

                // create a buffer of  maximum size
                bytesAvailable = fileInputStream.available();
                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                buffer = new byte[bufferSize];

                // read file and write it into form...
                bytesRead = fileInputStream.read(buffer, 0, bufferSize);

                while (bytesRead > 0) {
                    dos.write(buffer, 0, bufferSize);
                    bytesAvailable = fileInputStream.available();
                    bufferSize = Math.min(bytesAvailable, maxBufferSize);
                    bytesRead = fileInputStream.read(buffer, 0, bufferSize);
                }

                // send multipart form data necesssary after file data...
                dos.writeBytes(lineEnd);
                dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

                // Responses from the server (code and message)
                serverResponseCode = conn.getResponseCode();
                String serverResponseMessage = conn.getResponseMessage();

                Log.i(TAG, "HTTP Response is : "
                        + serverResponseMessage + ": " + serverResponseCode);

                if (serverResponseCode == 200) {
                    runOnUiThread(new Runnable() {
                        public void run() {
                            Toast.makeText(MainActivity.this, "File Upload Complete.", Toast.LENGTH_SHORT).show();

                            getInfo();

                            Handler mHandler = new Handler();
                            mHandler.postDelayed(new Runnable()  {
                                public void run() {
                                    setInfo();
                                }
                            }, 30000);
                        }
                    });
                }
                else startProgress.hide();
                //close the streams //
                fileInputStream.close();
                dos.flush();
                dos.close();
            } catch (MalformedURLException ex) {
                ex.printStackTrace();

                runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(MainActivity.this, "MalformedURLException", Toast.LENGTH_SHORT).show();
                    }
                });
            } catch (Exception e) {
                e.printStackTrace();

                runOnUiThread(new Runnable() {
                    public void run() {
                        Toast.makeText(MainActivity.this, "Got Exception : see logcat ",
                                Toast.LENGTH_SHORT).show();

                    }

                });
            }
            return serverResponseCode;
        }
    }

    public static Bitmap rotateImage(Bitmap source, float angle) {
        Matrix matrix = new Matrix();
        matrix.postRotate(angle);
        Log.d(TAG, "source.getWidth : " + source.getWidth() );
        return Bitmap.createBitmap(source, 0, 0, source.getWidth(), source.getHeight(),
                matrix, true);
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

                    if ( !deviceName.equals("취소")){
                        connectDevice(deviceName);
                    }
                    else {
                        Toast.makeText(getApplicationContext(), "블루투스 연결을 취소하셨습니다.", Toast.LENGTH_SHORT).show();
                    }
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