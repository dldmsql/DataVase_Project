package com.dvase.dvase_galleryuploadtest;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.Toolbar;

import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;
import com.squareup.picasso.Picasso;
import com.tistory.link2me.okhttpupload.R;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.text.SimpleDateFormat;
import java.util.Date;

public class MainActivity extends AppCompatActivity {

    Context mContext;

    private static final int PICK_FROM_CAMERA = 1; //카메라 촬영으로 사진 가져오기
    private static final int PICK_FROM_ALBUM = 2; //앨범에서 사진 가져오기
    private static final int CROP_FROM_CAMERA = 3; // 가져온 사진을 자르기 위한 변수

    private Uri mImageCaptureUri;
    private Bitmap mImageBitmap;
    String imagePath;

    ImageView imageView;
    TextView textView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        //상태바 없애기 -- 아직 제대로 동작 안됨
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
                WindowManager.LayoutParams.FLAG_FULLSCREEN);

        getWindow().setFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON,
                WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);

        setContentView(R.layout.activity_main);

        mContext = getApplicationContext();

        textView = (TextView) findViewById(R.id.textView);
        textView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DialogInterface.OnClickListener cameraListener = new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        // 카메라에서 사진 촬영
                        doTakePhotoAction();
                    }
                };
                DialogInterface.OnClickListener albumListener = new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        getGallery(); // 갤러리(앨범)에서 이미지 가져오기
                    }
                };
                DialogInterface.OnClickListener cancelListener = new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        dialogInterface.dismiss();
                    }
                };

                new AlertDialog.Builder(MainActivity.this)
                        .setTitle("업로드할 이미지 선택")
                        .setPositiveButton("사진촬영",cameraListener)
                        .setNeutralButton("앨범선택",albumListener)
                        .setNegativeButton("취소",cancelListener)
                        .show();
            }
        });

        imageView = (ImageView) findViewById(R.id.imageView);

        // 선택된 사진을 받아 서버에 업로드한다.
        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (!TextUtils.isEmpty(imagePath)) {
                    if (NetworkHelper.checkConnection(mContext)) { // 인터넷 연결 체크
                        String ImageUploadURL = "http://15.164.251.97/file_upload.php";
                        new ImageUploadTask().execute(ImageUploadURL, imagePath);
                    } else {
                        Toast.makeText(mContext, "인터넷 연결을 확인하세요", Toast.LENGTH_LONG).show();
                    }
                } else {
                    Toast.makeText(mContext, "먼저 업로드할 파일을 선택하세요", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    private  class ImageUploadTask extends AsyncTask<String, Integer, Boolean> {
        ProgressDialog progressDialog; // API 26에서 deprecated

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(MainActivity.this);
            progressDialog.setMessage("이미지 업로드중....");
            progressDialog.show();
        }

        @Override
        protected Boolean doInBackground(String... params) {

            try {
                JSONObject jsonObject = JSONParser.uploadImage(params[0],params[1]);
                if (jsonObject != null){
                    return jsonObject.getString("result").equals("success");
                }
            } catch (JSONException e) {
                Log.i("TAG", "Error : " + e.getLocalizedMessage());
            }
            return false;
        }

        @Override
        protected void onPostExecute(Boolean aBoolean) {
            super.onPostExecute(aBoolean);
            if (progressDialog != null)
                progressDialog.dismiss();

            if (aBoolean){
                Toast.makeText(getApplicationContext(), "파일 업로드 성공", Toast.LENGTH_LONG).show();
            }  else{
                Toast.makeText(getApplicationContext(), "파일 업로드 실패", Toast.LENGTH_LONG).show();
            }

            // 임시 파일 삭제 (카메라로 사진 촬영한 이미지)
            if(mImageCaptureUri != null){
                File file = new File(mImageCaptureUri.getPath());
                if(file.exists()) {
                    file.delete();
                }
                mImageCaptureUri = null;
            }

            imagePath = "";
            textView.setVisibility(View.VISIBLE);
            imageView.setVisibility(View.INVISIBLE);

        }
    }

    // 사진 선택을 위해 갤러리를 호출
    private void getGallery() {
        // File System.
        final Intent galleryIntent = new Intent();
        galleryIntent.setType("image/*");
        galleryIntent.setAction(Intent.ACTION_PICK);

        // Chooser of file system options.
        final Intent chooserIntent = Intent.createChooser(galleryIntent, "Select Image");
        startActivityForResult(chooserIntent, PICK_FROM_ALBUM);
    }

    private void doTakePhotoAction() {  // 카메라 앱을 이용하여 사진 찍기
        // Intent를 사용하여 안드로이드에서 기본적으로 제공해주는 카메라를 이용하는 방법 이용
        Intent cameraIntent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);

        // 임시로 사용할 파일의 경로를 생성
        String url = "CameraPicture_" + String.valueOf(new SimpleDateFormat( "yyyyMMdd_HHmmss").format( new Date())) + ".jpg";
        mImageCaptureUri = Uri.fromFile(new File(Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES), url));
        imagePath = mImageCaptureUri.getPath();
        // 이미지가 저장될 파일은 카메라 앱이 구동되기 전에 세팅해서 넘겨준다.
        cameraIntent.putExtra(android.provider.MediaStore.EXTRA_OUTPUT, mImageCaptureUri);
        cameraIntent.putExtra("return-data", true);

        startActivityForResult(cameraIntent, PICK_FROM_CAMERA); // 7.0 에서는 에러가 발생함. (API26 으로 컴파일 한 경우)
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if(resultCode != RESULT_OK) return;
        switch (requestCode){
            case PICK_FROM_ALBUM: {
                // URI 정보를 이용하여 이미지(사진) 정보를 가져온다.
                if (data == null) {
                    Toast.makeText(mContext, "Unable to Pickup Image", Toast.LENGTH_SHORT).show();
                    return;
                }
                Uri selectedImageUri = data.getData();
                String[] filePathColumn = {MediaStore.Images.Media.DATA};

                Cursor cursor = getContentResolver().query(selectedImageUri, filePathColumn, null, null, null);

                if (cursor != null) {
                    cursor.moveToFirst();

                    imagePath = cursor.getString(cursor.getColumnIndex(filePathColumn[0]));

                    Picasso.with(mContext).load(new File(imagePath))
                            .into(imageView); // 피카소 라이브러를 이용하여 선택한 이미지를 imageView에 출력
                    cursor.close();

                } else {
                    Snackbar.make(findViewById(R.id.parentView), "Unable to Load Image", Snackbar.LENGTH_LONG).setAction("Try Again", new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            getGallery();
                        }
                    }).show();
                }

                textView.setVisibility(View.GONE);
                imageView.setVisibility(View.VISIBLE);
                break;
            }

            case PICK_FROM_CAMERA: {
                // 이미지를 가져온 이후의 리사이즈할 이미지 크기를 결정
                Intent intent = new Intent("com.android.camera.action.CROP");
                intent.setDataAndType(mImageCaptureUri, "image/*");

                // CROP할 이미지를 125*170 크기로 저장
//                intent.putExtra("outputX", 125); // CROP한 이미지의 x축 크기
//                intent.putExtra("outputY", 170); // CROP한 이미지의 y축 크기
//                intent.putExtra("aspectX", 1); // CROP 박스의 X축 비율
//                intent.putExtra("aspectY", 1); // CROP 박스의 Y축 비율
                intent.putExtra("scale", true);
                intent.putExtra("return-data", true);

                startActivityForResult(intent, CROP_FROM_CAMERA); // CROP_FROM_CAMERA case문 이동
                break;
            }

            case CROP_FROM_CAMERA:  {
                // CROP 된 이후의 이미지를 넘겨 받음
                final Bundle extras = data.getExtras();
                if(extras != null) {
                    //mImageBitmap = extras.getParcelable("data"); // CROP된 BITMAP
                    mImageBitmap = (Bitmap)data.getExtras().get("data"); // CROP된 BITMAP
                    // 레이아웃의 이미지칸에 CROP된 BITMAP을 보여줌
                    saveCropImage(mImageBitmap,imagePath); //  CROP 된 이미지를 외부저장소, 앨범에 저장
                    break;
                }

                Picasso.with(mContext).load(new File(imagePath))
                        .into(imageView); // 피카소 라이브러를 이용하여 선택한 이미지를 imageView에 출력

                textView.setVisibility(View.GONE);
                imageView.setVisibility(View.VISIBLE);
                break;
            }

        }

    }

    // 저장된 사진을 사진 갤러리에 추가 (아직 테스트를 제대로 못한 부분)
    private void galleryAddPic(){
        Intent mediaScanIntent = new Intent( Intent.ACTION_MEDIA_SCANNER_SCAN_FILE);
        File file = new File( imagePath);
        Uri contentUri = Uri.fromFile(file);
        mediaScanIntent.setData( contentUri);
        this.sendBroadcast( mediaScanIntent);
    }

    // Bitmap 을 저장하는 메소드
    private void saveCropImage(Bitmap bitmap, String filePath) {
        File copyFile = new File(filePath);
        BufferedOutputStream bos = null;
        try {
            copyFile.createNewFile();
            bos = new BufferedOutputStream(new FileOutputStream(copyFile));
            bitmap.compress(Bitmap.CompressFormat.JPEG, 100, bos); // 이미지가 클 경우 OutOfMemoryException 발생이 예상되어 압축
            // sendBroadcast를 통해 Crop된 사진을 앨범에 보이도록 갱신한다.
            sendBroadcast(new Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE, Uri.fromFile(copyFile)));

            bos.flush();
            bos.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
    }}