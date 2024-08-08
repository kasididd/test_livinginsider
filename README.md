# test_livinginsider
[GitHub link Clik](https://github.com/kasididd/test_livinginsider)


<!-- lastest -->

สามารถเข้าไปดู Demo ได้ที่ [https://www.wansudon.site/]


สามารถเข้าไปดูข้อมูล Flutter Dashboard คร่าวๆได้ที่ [https://dashboard.wansudon.site/]

เมื่อกด คำนวณสินเชื่อผมได้ทำการส่งข้อมูลเข้า PHP API Storage to SQL สามารถดู ฐานข้อมูลได้ที่ [http://34.87.76.190:8081/]

**ใช้ vm ที่มีประสิทธิภาพสูงของ Google ราคาอยู่ที่ $178(6,326.12 บาท)/month**
**ใช้ cer ของ certbot ยืนยันความเป็นเจ้าของผ่าน email** ref [https://shorturl.at/KQTea]

--- mini server ใช้ไม่ได้ v-core-0.5 ram น้อยเกินไป 600 mb ---
สามารถเข้าไปดู Demo ได้ที่ [https://m.wansudon.site/]

สามารถเข้าไปดูข้อมูล Flutter Dashboard คร่าวๆได้ที่ [https://d.wansudon.site/]

เมื่อกด คำนวณสินเชื่อผมได้ทำการส่งข้อมูลเข้า PHP API Storage to SQL สามารถดู ฐานข้อมูลได้ที่ [http://35.229.190.41:8081/]

**ใช้ vm ที่มีประสิทธิภาพต่ำสุดของ Google ราคาอยู่ที่ $5.80(206.54 บาท)/month**
**ใช้ cer ของ certbot ยืนยันความเป็นเจ้าของผ่าน email** ref [https://shorturl.at/KQTea]


--- mini-3 server ใช้ได้ลื่่นไหลดี v-core-1 ram 1.7GB ---
สามารถเข้าไปดู Demo ได้ที่ [https://main.wansudon.site/]

สามารถเข้าไปดูข้อมูล Flutter Dashboard คร่าวๆได้ที่ [https://dash.wansudon.site/]

เมื่อกด คำนวณสินเชื่อผมได้ทำการส่งข้อมูลเข้า PHP API Storage to SQL สามารถดู ฐานข้อมูลได้ที่ [http://35.185.143.73:8081/]

**ใช้ vm ที่มีประสิทธิภาพต่ำสุดของ Google ราคาอยู่ที่ $15.53(548.25 บาท)/month**

<!-- old -->
สามารถเข้าไปดู Demo ได้ที่ [http://www.wansudon.site/]

#เพิ่มเติม(ShowCase)
สามารถเข้าไปดูข้อมูล Flutter Dashboard คร่าวๆได้ที่ [http://34.163.150.173:8080/]

เมื่อกด คำนวณสินเชื่อผมได้ทำการส่งข้อมูลเข้า PHP API Storage to SQL สามารถดู ฐานข้อมูลได้ที่ [http://34.163.150.173:8081/]
Server    : db
User      : root
Password  : root
Database  : db

[-] ข้อมูลจะถูกอ่านค่าจาก Flutter Dashboard Web โดยใช้การจัดการ Deploy ด้วย Docker สามารถ Restart อัตโนมัติหากมีข้อผิดพลาด และทำการ Backup Database ตลอดเวลา(เชื่อมด้วย Docker file path)
ทำให้การ backup ข้อมูลไม่กิน ทรัพยากรณ์ ในการประมวลผล

[-] ปกติ อาจจะต้องมีการเก็บ Log Error แยกออกมาหรือมีการยิง Api เข้าแจ้งเตือนเป็นต้นแต่เนื่องจากนี่เป็นเพียง Show Case จึงอาจไม่ได้ทำระบบในส่วนนั้นครับ
สำหรับ https เนื่องจากต้องมีการ config cert ผมจึงไม่ได้ทำเนื่องจากใช้วเลา แต่สำหรับการทำ https ก็มีวิธีง่ายๆเช่นการ deploy ผ่าน firebase Hosting แต่เนื่องจาก เคสนี้ทำผ่าน HTML

จึงไม่ได้ใช้ Firebase ดังนั้นจึงเลือก stack ที่เป็น google VM แทนเพื่อความเหมาะสมครับ

ปล. หากมีข้อผิดพลาดประการใดขออภัยเป็นอย่างสูง หวังอย่างยิ่งว่าจะได้ร่วมงานกันครับ


-- setup
sudo apt-get install apache2
sudo apt-get install apache2-utils
sudo apt install git docker-compose docker certbot python3-certbot-apache
sudo git clone https://github.com/kasididd/test_livinginsider.git
sudo a2enmod proxy_http
sudo a2enmod proxy_balancer
sudo a2enmod proxy_wstunnel
sudo systemctl restart apache2 ufw

sudo mv /etc/apache2/sites-available/000-default.conf  /etc/apache2/sites-available/origdefault.backup
sudo nano /etc/apache2/sites-available/app.conf

  <VirtualHost *:443>

     ServerName main.wansudon.site

     ProxyPreserveHost On
     ProxyPass / http://127.0.0.1:888/
     ProxyPassReverse / http://127.0.0.1:888/

  </VirtualHost>
  <VirtualHost *:443>

     ServerName dash.wansudon.site

     ProxyPreserveHost On
     ProxyPass / http://127.0.0.1:8080/
     ProxyPassReverse / http://127.0.0.1:8080/

  </VirtualHost>

sudo ln -s /etc/apache2/sites-available/app.conf  /etc/apache2/sites-enabled/app.conf
sudo apachectl configtest
sudo service apache2 restart

-> set 35.185.143.73 -> dns a-record

sudo ufw allow 443/tcp
sudo ufw reload

sudo certbot -d main.wansudon.site

sudo certbot -d dash.wansudon.site

sudo certbot renew --dry-run

sudo nano /etc/apache2/sites-enabled/app.conf

cd test_livinginsider/docker/
sudo docker-compose up -d

-  config flutter server_url

-  git commit

sudo git pull
