package com.dvase.dvase_galleryuploadtest;

import android.content.Context;
import android.net.ConnectivityManager;

public class NetworkHelper {

	/** CHECK WHETHER INTERNET CONNECTION IS AVAILABLE OR NOT */
	public static boolean checkConnection(Context context) {
		return  ((ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE)).getActiveNetworkInfo() != null;
	}
}
