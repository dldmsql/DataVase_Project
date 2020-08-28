package com.dvase.dvase;

import java.util.List;

import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.cookie.Cookie;
import cz.msebera.android.httpclient.impl.client.DefaultHttpClient;

public class SessionControl {
    static public DefaultHttpClient httpclient = null;
    static public List<Cookie> cookies;

    public static HttpClient getHttpClient() {
        if (httpclient == null) {
            SessionControl.setHttpclient(new DefaultHttpClient());
        }
        return httpclient;
    }

    public static void setHttpclient(DefaultHttpClient httpclient) {

        SessionControl.httpclient = httpclient;
    }
}