from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
capabilities = DesiredCapabilities.FIREFOX.copy()
capabilities['marionette'] = False
driver = webdriver.Firefox(capabilities=capabilities)
driver.manage().timeouts().implicitlyWait(30,TimeUnit.SECONDS);
driver.get("https://ekyc.aircel.com:444/ekyc/genUPC.html")