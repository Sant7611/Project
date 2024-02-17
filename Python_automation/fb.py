from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

driver = webdriver.Chrome()
driver.get("https://google.com")
search = driver.find_element(By.ID, "APjFqb")
search.send_keys(Keys.RETURN)
# driver.get("https://www.facebook.com")
# username_element = driver.find_element(By.ID,'email')
# password_element = driver.find_element(By.ID,'pass')

# username_element.send_keys('sbohara579@gmail.com')
# password_element.send_keys('#$antosh@21')
# password_element.send_keys(Keys.RETURN)
time.sleep(500)

driver.close()