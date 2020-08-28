package com.dvase.dvase;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.net.Uri;
import android.os.Handler;
import android.provider.MediaStore;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;

public class ListViewAdapter extends BaseAdapter {

    private ArrayList<VOGarden> listVO;
    private static final String TAG = "kyurii";
    private Context context = null;
    private ImageButton imageButton, cooltimeButton, commentButton, progressButton;

    public ListViewAdapter(){
        this.listVO = new ArrayList<VOGarden>();
    }

    @Override
    public int getCount() {
        return this.listVO.size();
    }

    @Override
    public Object getItem(int i) {
        return listVO.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }

    public void addVO(VOGarden voStudent){
        this.listVO.add(voStudent);
    }
    public void removeAll(){
        this.listVO.clear();
    }
    @Override
    public View getView(final int position, View view, ViewGroup parent) {
        final int pos = position;
        context = parent.getContext();

        if ( view == null ){
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view = inflater.inflate(R.layout.custom_listview, parent, false);
        }
        ImageView oPlantImage = (ImageView) view.findViewById(R.id.plant_image);
        TextView oDate = (TextView) view.findViewById(R.id.date);
        TextView oPlantName = (TextView) view.findViewById(R.id.plant_name);

        File file = new File(listVO.get(position).getPlantImagePath());
        try {
            Bitmap bitmap = MediaStore.Images.Media.getBitmap(context.getContentResolver(), Uri.fromFile(file));
            oPlantImage.setImageBitmap(bitmap);
        } catch (IOException e) {
            e.printStackTrace();
        }
        oDate.setText(listVO.get(position).getDate());
        oPlantName.setText(listVO.get(position).getPlantName());

        view.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showIntent(listVO.get(position).getPlantID());
            }
        });

        return view;
    }
    private void showIntent(String ID){
        Intent intent = new Intent(context, Popup_9_9.class);
        intent.putExtra("controller", "dvase" );
        intent.putExtra("mode", "testView" );
        intent.putExtra("ID", ID );

        context.startActivity(intent);
    }
}
