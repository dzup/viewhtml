import requests
import os
import urllib
import re
import random
import argparse

# https://www.bing.com/images/search?q=wallpapers%204k
from bs4 import BeautifulSoup
from urllib2 import Request, urlopen

#process arguments
parser = argparse.ArgumentParser(
    formatter_class=argparse.RawDescriptionHelpFormatter,
    description='Download random wallpapers from bing.com', 
    usage='%(prog)s [options]', 
    epilog='''\
        Example use: %(prog)s q="wallpapers 4k" 
        to download random wallpapers that contains the
        word "wallpapers 4k"
        ''')
parser.add_argument('--version', action='version', version='%(prog)s 1.0')
parser.add_argument('--verbose', '-v', action='count')
parser.add_argument('q', default='wallpaper 4k')

args = parser.parse_args()
newq=args.q.replace(" ", "%20")
#html_url = "https://www.bing.com/images/search?" + newq + "&last=" + str(random.randint(0, 20)) + "&scenario=ImageBasicHover"
#html_url = "https://www.bing.com/images/search?" + newq + "&last=13&scenario=ImageBasicHover"

#ok, latest without anynumber gets me the latest post, lets try popular
#html_url = "https://www.bing.com/images/search?" + newq + "&lastest&scenario=ImageBasicHover"

#popular, returns i guess popular links, can change, but needs voters aproval (guessing), lets try words, like unique
html_url = "https://www.bing.com/images/search?" + newq + "&&scenario=ImageBasicHover"


print
print(html_url)
print

html_page = urllib.urlopen("https://www.bing.com/images/search?q=wallpapers 4k")
req = Request(html_url, headers={'User-Agent': 'Mozilla/5.0'})
html_page = urlopen(req).read()

soup = BeautifulSoup(html_page, "html.parser")
soup = BeautifulSoup(html_page, "lxml")
for link in soup.find_all('a'):
    print(link.get('href'))

#print(soup.prettify())

links = []
for link in soup.findAll('a'):
    print(link)
    links.append(link.get('href'))

#print(links)
#exit()

images_types = ['.png', '.jpg', '.svg']
for img in links:
    for n in images_types:
        if n in img:
            print(img)
print

