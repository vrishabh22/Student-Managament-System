from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
browser = webdriver.Chrome('G:\software engineering\chromedriver.exe')
browser.get("http://localhost:8080/hms1/login.jsp")
time.sleep(1)
username = browser.find_element_by_name("username")
password = browser.find_element_by_name("password")

username.send_keys("neymar")
password.send_keys("qwerty")
login_attempt = browser.find_element_by_xpath("//*[@type='submit']")
login_attempt.submit()