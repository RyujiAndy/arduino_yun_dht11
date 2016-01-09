#include "DHT.h"
#include <Bridge.h>
#include <YunServer.h>
#include <YunClient.h>

#define DHTPIN 2
#define DHTTYPE DHT11 

YunServer server;
DHT dht(DHTPIN, DHTTYPE);
int h, t;

void setup() {
  Bridge.begin();
  server.listenOnLocalhost();
  server.begin();
  dht.begin();
}

void loop() {
  h = dht.readHumidity();
  t = dht.readTemperature();

  YunClient client = server.accept();
  if (client) {
    process(client);
    client.stop();
  }
  
  delay(50);
}

void process(YunClient client) {
  
  String command = client.readStringUntil('\r');

  if (command == "termo") {
    temp(client);
  }

  if (command == "idro") {
    idro(client);
  }
}

void temp(YunClient client) {
  if (isnan(t)) {
    client.print(F("Error"));
  } else {
    client.print(t);
  }
}

void idro(YunClient client) {
    if (isnan(t)) {
      client.print(F("Error"));
    } else {
      client.print(h);
    }
}
