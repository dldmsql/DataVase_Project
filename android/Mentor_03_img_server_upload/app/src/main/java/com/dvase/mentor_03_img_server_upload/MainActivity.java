package com.dvase.mentor_03_img_server_upload;


import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.FileProvider;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.Matrix;
import android.media.ExifInterface;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.text.SimpleDateFormat;
import java.util.Date;

public class MainActivity extends AppCompatActivity implements View.OnClickListener {

    final String TAG = "kyurii";
    ImageView imageView;
    Button cameraBtn;
    final static int TAKE_PICTURE = 1;
    String mCurrentPhotoPath;
    static final int REQUEST_TAKE_PHOTO = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // 레이아웃과 변수 연결
        imageView = findViewById(R.id.imageview);
        cameraBtn = findViewById(R.id.camera_button);

        // 카메라 버튼에 리스터 추가
        cameraBtn.setOnClickListener(this);

        // 6.0 마쉬멜로우 이상일 경우에는 권한 체크 후 권한 요청
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (checkSelfPermission(Manifest.permission.CAMERA) == PackageManager.PERMISSION_GRANTED && checkSelfPermission(Manifest.permission.WRITE_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED ) {
                Log.d(TAG, "권한 설정 완료");
            } else {
                Log.d(TAG, "권한 설정 요청");
                ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.CAMERA, Manifest.permission.WRITE_EXTERNAL_STORAGE}, 1);
            }
        }
    }

    // 권한 요청
    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        Log.d(TAG, "onRequestPermissionsResult");
        if (grantResults[0] == PackageManager.PERMISSION_GRANTED && grantResults[1] == PackageManager.PERMISSION_GRANTED ) {
            Log.d(TAG, "Permission: " + permissions[0] + "was " + grantResults[0]);
        }
    }
    @Override
    public void onClick(View v) {
        switch(v.getId()){
            case R.id.camera_button:
                // 카메라 앱을 여는 소스
                dispatchTakePictureIntent();
                break;
        }
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

        // Save a file: path for use with ACTION_VIEW intents
        mCurrentPhotoPath = image.getAbsolutePath();
        return image;
    }

    private void dispatchTakePictureIntent() {
        Log.d(TAG, "dispatchTakePictureIntent" );
        Intent takePictureIntent = new Intent( MediaStore.ACTION_IMAGE_CAPTURE );
        // Ensure that there's a camera activity to handle the intent
        if (takePictureIntent.resolveActivity(getPackageManager()) != null) {
            // Create the File where the photo should go
            File photoFile = null;
            try {
                photoFile = createImageFile();
                Log.d(TAG, "photoFile : " + photoFile);
            } catch (IOException ex) {
                // Error occurred while creating the File
            }
            // Continue only if the File was successfully created
            if (photoFile != null) {
                Uri photoURI = FileProvider.getUriForFile(this,"com.example.myapp.fileprovider", photoFile);
                Log.d(TAG, "photoURI : " + photoURI );
                takePictureIntent.putExtra(MediaStore.EXTRA_OUTPUT, photoURI);
                startActivityForResult(takePictureIntent, REQUEST_TAKE_PHOTO);
            }
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent intent) {
        super.onActivityResult(requestCode, resultCode, intent);
        try {
            switch (requestCode) {
                case REQUEST_TAKE_PHOTO: {
                    if (resultCode == RESULT_OK) {
                        File file = new File(mCurrentPhotoPath);//r걱정 안 하고 있었는데... 갑자기 걱정이 확 밀려오네....;;;;
                        Bitmap bitmap = MediaStore.Images.Media
                                .getBitmap(getContentResolver(), Uri.fromFile(file));
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

                            Log.d(TAG, "imageSetting");
                            Log.d(TAG, "mCurrentPhotoPath : " + mCurrentPhotoPath );
                            imageView.setImageBitmap(rotatedBitmap);

                            imageUpload();
                        }
                    }
                    break;
                }
            }

        } catch (Exception error) {
            error.printStackTrace();
        }
    }
    private void imageUpload() {
        String ImageUploadURL = "http://15.164.251.97/dvase/file_upload";
        new ImageUploadTask().execute(ImageUploadURL, mCurrentPhotoPath);

//        HttpFileUpload(ImageUploadURL, "", mCurrentPhotoPath);
    }

    public static Bitmap rotateImage(Bitmap source, float angle) {
        Matrix matrix = new Matrix();
        matrix.postRotate(angle);
        return Bitmap.createBitmap(source, 0, 0, source.getWidth(), source.getHeight(),
                matrix, true);
    }

    //OKHTTP 사용 이미지 업로드 > 실패
//
    private  class ImageUploadTask extends AsyncTask<String, Integer, Boolean> {
        ProgressDialog progressDialog;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(MainActivity.this);
            progressDialog.setMessage("이미지 업로드중....");
            progressDialog.show();
        }

        @Override
        protected Boolean doInBackground(String... params) {
            Log.d(TAG, "params[0] : " + params[0]);
            Log.d(TAG, "params[1] : " + params[1]);
            try {
                JSONObject jsonObject = JSONParser.uploadImage(params[0],params[1]);
                if (jsonObject != null)
                    return jsonObject.getString("result").equals("success");

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

            if (aBoolean)
                Toast.makeText(getApplicationContext(), "파일 업로드 성공", Toast.LENGTH_LONG).show();
            else
                Toast.makeText(getApplicationContext(), "파일 업로드 실패", Toast.LENGTH_LONG).show();
//
//            imagePath = "";
//            textView.setVisibility(View.VISIBLE);
//            imageView.setVisibility(View.INVISIBLE);
        }
    }

    String lineEnd = "\r\n";
    String twoHyphens = "--";
    String boundary = "*****";

    public void HttpFileUpload(String urlString, String params, String fileName) {
        Log.d(TAG, "httpfileUpload");
        try {
            FileInputStream mFileInputStream;
            mFileInputStream = new FileInputStream(fileName);
            URL connectUrl = new URL(urlString);
            Log.d("Test", "mFileInputStream  is " + mFileInputStream);

            // open connection
            HttpURLConnection conn = (HttpURLConnection)connectUrl.openConnection();
            conn.setDoInput(true);
            conn.setDoOutput(true);
            conn.setUseCaches(false);
            conn.setRequestMethod("POST");
            conn.setRequestProperty("Connection", "Keep-Alive");
            conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);

            // write data
            DataOutputStream dos = new DataOutputStream(conn.getOutputStream());
            dos.writeBytes(twoHyphens + boundary + lineEnd);
            dos.writeBytes("Content-Disposition: form-data; name=\"uploadedfile\";filename=\"" + fileName+"\"" + lineEnd);
            dos.writeBytes(lineEnd);

            int bytesAvailable = mFileInputStream.available();
            int maxBufferSize = 1024;
            int bufferSize = Math.min(bytesAvailable, maxBufferSize);

            byte[] buffer = new byte[bufferSize];
            int bytesRead = mFileInputStream.read(buffer, 0, bufferSize);

            Log.d(TAG, "image byte is " + bytesRead);

            // read image
            while (bytesRead > 0) {
                dos.write(buffer, 0, bufferSize);
                bytesAvailable = mFileInputStream.available();
                bufferSize = Math.min(bytesAvailable, maxBufferSize);
                bytesRead = mFileInputStream.read(buffer, 0, bufferSize);
            }

            dos.writeBytes(lineEnd);
            dos.writeBytes(twoHyphens + boundary + twoHyphens + lineEnd);

            // close streams
            Log.e(TAG , "File is written");
            mFileInputStream.close();
            dos.flush(); // finish upload...

            // get response
            int ch;
            InputStream is = conn.getInputStream();
            StringBuffer b =new StringBuffer();
            while( ( ch = is.read() ) != -1 ){
                b.append( (char)ch );
            }
            String s=b.toString();
            Log.e(TAG, "result = " + s);
            dos.close();

        } catch (Exception e) {
            Log.d(TAG, "exception " + e.getMessage());
            // TODO: handle exception
        }
    }
}
