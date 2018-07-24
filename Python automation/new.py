import xlrd
import xlsxwriter
import time
#import xlsxwriter
from xlrd import open_workbook
from xlwt import Workbook
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait as wait
from selenium.common.exceptions import TimeoutException
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import StaleElementReferenceException
from selenium.common.exceptions import NoAlertPresentException
from selenium.webdriver.support.ui import Select
workbook1 = xlsxwriter.Workbook('output.xlsx')
worksheet1 = workbook1.add_worksheet()
options = webdriver.ChromeOptions()
options.add_argument('--ignore-certificate-errors')
options.add_argument('--ignore-ssl-errors')
driver = webdriver.Chrome('C:/Users/Backoffice/Downloads/chromedriver_win32/chromedriver.exe',chrome_options=options)
driver.get("http://35.154.143.159/upc/getUPC.jsp")
cell_value_by_value = 1
workbook = xlrd.open_workbook('excel.xlsx')
worksheet = workbook.sheet_by_name('Sheet1')
newsheet=0
rowcount = worksheet.nrows-1
visible=1
#while cell_value_by_value <= rowcount:			
#	url = worksheet.cell(cell_value_by_value, 1)
#	print (int(url.value))
#	cell_value_by_value = cell_value_by_value + 1
while cell_value_by_value <= rowcount:
	link = None
	while not link:
		try:
			link = driver.find_element_by_name('msisdn')
			visible=0
			#print ("ele")
		except (NoSuchElementException,NameError):
			#print (link)
			driver.get("http://35.154.143.159/upc/getUPC.jsp")
			visible=1
			time.sleep(10)
		if visible==0:
			driver.find_element_by_name('msisdn').clear()
			time.sleep(1)
			driver.find_element_by_name('simnumber').clear()
			time.sleep(1)
			No = worksheet.cell(cell_value_by_value, 0)
			Pin = worksheet.cell(cell_value_by_value, 1)
			n_No = int(No.value)
			n_Pin = int(Pin.value)
			TextNo = driver.find_element_by_name('msisdn')
			TextNo.send_keys(n_No)
			TextPin =  driver.find_element_by_name('simnumber')
			TextPin.send_keys(n_Pin)
			select = Select(driver.find_element_by_name('circle'))			
			select.select_by_visible_text('Chennai')
			python_button = driver.find_element_by_xpath("//input[@type='submit']")
			python_button.click()
			time.sleep(2)
			b = driver.find_elements_by_xpath("//b")
			print (b[1].text)
			worksheet1.write(newsheet, 0, n_No)
			worksheet1.write(newsheet, 1, n_Pin)
			worksheet1.write(newsheet, 2, b[1].text)
			newsheet = newsheet + 1
			cell_value_by_value = cell_value_by_value + 1
workbook1.close()