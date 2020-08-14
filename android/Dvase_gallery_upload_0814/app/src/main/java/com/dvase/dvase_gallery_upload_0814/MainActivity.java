package com.dvase.dvase_gallery_upload_0814;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.io.DataOutputStream;
import java.io.File;
import java.io.FileInputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class MainActivity extends AppCompatActivity {

    public static final String TAG = "kyurii";


    private static final int PICK_FROM_CAMERA = 1; //카메라 촬영으로 사진 가져오기
    private static final int PICK_FROM_ALBUM = 2; //앨범에서 사진 가져오기
    private static final int CROP_FROM_CAMERA = 3; // 가져온 사진을 자르기 위한 변수

    Button uploadButton, btnselectpic;
    ImageView profilePic;
    private int serverResponseCode = 0;
    private String upLoadServerUri = null;
    private String imagepath = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        uploadButton = findViewById(R.id.uploadButton);
        btnselectpic = (Button) findViewById(R.id.button_selectpic);
        profilePic = findViewById(R.id.profile_picture);

        btnselectpic.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectProfilPic();
            }
        });

        uploadButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                uploadProfilPic();
            }
        });

        upLoadServerUri = "http://15.164.251.97/dvaseFolder/uploadFile.php";
    }

    private void selectProfilPic() {
        Log.d(TAG, "selectProfilePic");
        // File System.
        final Intent galleryIntent = new Intent();
        galleryIntent.setType("image/*");
        galleryIntent.setAction(Intent.ACTION_PICK);

        // Chooser of file system options.
        final Intent chooserIntent = Intent.createChooser(galleryIntent, "Select Image");
        startActivityForResult(chooserIntent, PICK_FROM_ALBUM);

//        Intent intent = new Intent();
//        intent.setType("image/*");
//        intent.setAction(Intent.ACTION_GET_CONTENT);
//        startActivityForResult(Intent.createChooser(intent, "Complete action using"), 1);
    }

    private void uploadProfilPic() {
        new Thread(new Runnable() {
            public void run() {

                Log.d(TAG, "imagePath : " + imagepath);
                uploadFile(imagepath);

            }
        }).start();
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (resultCode != RESULT_OK) return;
        switch (requestCode) {
            case PICK_FROM_ALBUM: {
                // URI 정보를 이용하여 이미지(사진) 정보를 가져온다.
                if (data == null) {
                    Toast.makeText(this, "Unable to Pickup Image", Toast.LENGTH_SHORT).show();
                    return;
                }
                Uri selectedImageUri = data.getData();
                imagepath = getPath(selectedImageUri);

                Log.d(TAG, "image : " + imagepath);
//                String[] filePathColumn = {MediaStore.Images.Media.DATA};
//
//                Cursor cursor = getContentResolver().query(selectedImageUri, filePathColumn, null, null, null);
//
//                if (cursor != null) {
//                    cursor.moveToFirst();
//
//                    imagePath = cursor.getString(cursor.getColumnIndex(filePathColumn[0]));
//
//                    Bitmap bitmap = BitmapFactory.decodeFile(imagepath);
//                    profilePic.setImageBitmap(bitmap);
//                    cursor.close();
//                }
                break;
            }
        }
    }

//    @Override
//    public void onActivityResult(int requestCode, int resultCode, Intent data) {
//        super.onActivityResult(requestCode, resultCode, data);
//        if (requestCode == 1 && resultCode == RESULT_OK) {
//            //Bitmap photo = (Bitmap) data.getData().getPath();
//
//            Log.d(TAG, "onActivityResult");
//            Uri selectedImageUri = data.getData();
//
//            Log.d(TAG, "selectedImageUri : " + selectedImageUri);
//            imagepath = getPath(selectedImageUri);
//            Bitmap bitmap = BitmapFactory.decodeFile(imagepath);
//            profilePic.setImageBitmap(bitmap);
//        }
//    }

    public String getPath(Uri uri) {
        String[] filePathColumn = {MediaStore.Images.Media.DATA};

        Cursor cursor = getContentResolver().query(uri, filePathColumn, null, null, null);

        if (cursor != null) {
            cursor.moveToFirst();

            String path = cursor.getString(cursor.getColumnIndex(filePathColumn[0]));

            Bitmap bitmap = BitmapFactory.decodeFile(path);
            profilePic.setImageBitmap(bitmap);
            cursor.close();

            return path;
        }
        return null;
//        String[] projection = {MediaStore.Images.Media.DATA};
//        @SuppressWarnings("deprecation")
//        Cursor cursor = managedQuery(uri, projection, null, null, null);
//        int column_index = cursor.getColumnIndexOrThrow(MediaStore.Images.Media.DATA);
//        cursor.moveToFirst();
//        return cursor.getString(column_index);
    }


    //    public int uploadFile(String sourceFileUri) {
//        Log.d(TAG, "uploadFile_sourceFileUri : " + sourceFileUri);
//        String fileName = sourceFileUri;
//
//        HttpURLConnection conn = null;
//        DataOutputStream dos = null;
//        String lineEnd = "\r\n";
//        String twoHyphens = "--";
//        String boundary = "*****";
//        int bytesRead, bytesAvailable, bufferSize;
//        byte[] buffer;
//        int maxBufferSize = 1 * 1024 * 1024;
//        File sourceFile = new File(sourceFileUri);
//
//        if (!sourceFile.isFile()) {
//            Log.e("uploadFile", "Source File not exist :" + imagepath);
//
//            runOnUiThread(new Runnable() {
//                public void run() {
//                }
//            });
//
//            return 0;
//
//        } else {
//            try {
//
//                // open a URL connection to the Servlet
//                FileInputStream fileInputStream = new FileInputStream(sourceFile);
//                URL url = new URL(upLoadServerUri);
//
//                Log.d(TAG, "url : " + url);
//
//                // Open a HTTP  connection to  the URL
//                conn = (HttpURLConnection) url.openConnection();
//                conn.setDoInput(true); // Allow Inputs
//                conn.setDoOutput(true); // Allow Outputs
//                conn.setUseCaches(false); // Don't use a Cached Copy
//                conn.setRequestMethod("POST");
//                conn.setRequestProperty("Connection", "Keep-Alive");
//                conn.setRequestProperty("ENCTYPE", "multipart/form-data");
//                conn.setRequestProperty("Content-Type", "multipart/form-data;boundary=" + boundary);
//                conn.setRequestProperty("uploaded_file", fileName);
//
//                dos = new DataOutputStream(conn.getOutputStream());
//
//                dos.writeBytes(twoHyphens + boundary + lineEnd);
//                dos.writeBytes("Content-Disposition: form-data; name=\"uploaded_file\";filename=\""
//                        + fileName + "\"" + lineEnd);
//
//                dos.writeBytes(lineEnd);
//
//                // create a buffer of  maximum size
//                bytesAvailable = fileInputStream.available();
//
//                bufferSize = Math.min(bytesAvailable, maxBufferSize);
//                buffer = new byte[bufferSize];
//
//                // read file and write it into form...
//                bytesRead = fileInputStream.read(buffer, 0, bufferSize);
//
//                Log.d(TAG, "bytesRead : " + bytesRead );
//                if (bytesRead > 0) {
//                    Log.d(TAG, "bytesRead : " + bytesRead );
//                    dos.write(buffer, 0, bufferSize);
//                }
//
//                Log.d(TAG, "dos : " + dos);
//                Log.d(TAG, "dos.toString() : " + dos.toString());
//
//                return 1;
//            }
//            catch(Exception e){
//                Log.d(TAG, "오류 발생!! 꺄악");
//                e.printStackTrace();
//            }
//        }
//        return 0;
//    }
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
                        }
                    });
                }
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
}