package com.dvase.dvase;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.Handler;
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
    public View getView(int position, View convertView, ViewGroup parent) {
        final int pos = position;
        context = parent.getContext();

        if ( convertView == null ){
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.custom_listview, parent, false);
        }

        ImageView image = (ImageView) convertView.findViewById((R.id.img));
        TextView name = (TextView) convertView.findViewById(R.id.name);
        final TextView contact = (TextView) convertView.findViewById(R.id.contact);

        return convertView;
    }
}
