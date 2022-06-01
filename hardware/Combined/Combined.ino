/**************************************************************************************************
* _       ____   __   _____  _     ____  ___       __  _____   __   _____  _   ___   _            *
*\ \    /| |_   / /\   | |  | |_| | |_  | |_)     ( (`  | |   / /\   | |  | | / / \ | |\ |        *
* \_\/\/ |_|__ /_/--\  |_|  |_| | |_|__ |_| \     _)_)  |_|  /_/--\  |_|  |_| \_\_/ |_| \|        *
*                                                                                                 *
* SMART SENSORS PROJECT - REMOTE WEATHER STATION                                                  *
* BY - ABHAY SV(SE21MEEE001) , MAHESH BHARATH(SE21MEEE010)                                        *
*                                                                                                 *
**************************************************************************************************/  
//------------------------[INCLUDES]--------------------------                                                                          
#include <DHT.h> 
#include <ESP8266WiFi.h>

//------------------------[WIFI CONFIG]-----------------------
const char *ssid = "Mahesh";       
const char *pass = "12345678";

//------------------------[POST REQUEST CONFIG]---------------
const char *server = "api.thingspeak.com";
String apiKey = "JILE4HUXIVMTY0WJ";

//------------------------[SENSOR PIN CONFIGS]----------------
#define DHTPIN 3 
DHT dht(DHTPIN, DHT11);

#define GASPIN A0 

#define RAINPIN 1 

WiFiClient client;
//------------------------------------------------------------

//------------------------------>[INITS]<---------------------
void Get_Sensor_Data();
void Send_Data_To_API();

float humidity = 0;
float temperature = 0;
int gas_level = 0;
int rain_detected = 0;

//------------------------------>[SETUP]<---------------------
void setup()
{
       //=======[SERIAL COM]===========
       Serial.begin(115200);
       delay(1000);
       //=======[DHT INIT]=============
       dht.begin();
       //=======[WIFI INIT]============
       Serial.println("Connecting to ");
       Serial.println(ssid);

       WiFi.begin(ssid, pass);

       while (WiFi.status() != WL_CONNECTED)
       {
              delay(500);
              Serial.print(".");
       }
       Serial.println("");
       Serial.println("WiFi connected");
       //================================
}
//------------------------------------------------------------

//------------------------------>[LOOP]<---------------------
void loop()
{
       Get_Sensor_Data();
       delay(10);
       Send_Data_To_API();
       Serial.println("Waiting...");
       // thingspeak needs minimum 15 sec delay between updates
       delay(1000);
}

//----------------------------------------------------------------------
//------------------------------>[GET SENSOR DATA]<---------------------
void Get_Sensor_Data()
{
      humidity = dht.readHumidity();
      temperature = dht.readTemperature();
      
      gas_level = analogRead(GASPIN);
      if (isnan(gas_level))
        Serial.println("Failed to read from MQ-5 sensor!");
      else
        gas_level = (gas_level/1023)*100;
        
      rain_detected = digitalRead(RAINPIN);
      if (isnan(rain_detected))
        Serial.println("Failed to read from MQ-5 sensor!");  

      Serial.print("Temperature: ");
      Serial.print(temperature);
      Serial.print("/t Humidity: ");
      Serial.print(humidity);  
      Serial.print("/t Gas Level: ");
      Serial.print(gas_level);
      Serial.print("/t Rain Detected: ");
      Serial.println(rain_detected);
}
//------------------------------>[SEND DATA TO API]<---------------------
void Send_Data_To_API()
{
       if (client.connect(server, 80)) //   "184.106.153.149" or api.thingspeak.com
       {

              String postStr = apiKey;
              postStr += "&field1=";
              postStr += String(temperature);
              postStr += "&field2=";
              postStr += String(humidity);
              postStr += "&field3=";
              postStr += String(gas_level);
              postStr += "&field4=";
              postStr += String(rain_detected);
              postStr += "\r\n\r\n";

              client.print("POST /update HTTP/1.1\n");
              client.print("Host: api.thingspeak.com\n");
              client.print("Connection: close\n");
              client.print("X-THINGSPEAKAPIKEY: " + apiKey + "\n");
              client.print("Content-Type: application/x-www-form-urlencoded\n");
              client.print("Content-Length: ");
              client.print(postStr.length());
              client.print("\n\n");
              client.print(postStr);

              Serial.println("%. Sent Data to Thingspeak.");
       }
       client.stop();
      
}
