import urllib2
import urllib

url = 'http://192.168.1.77:8080/fakebox/check'
content =  raw_input("Enter content")
title = 'Reports just revealed the first concrete link between Trump campaign and Russian military intelligence'
values = {'url' : 'http://occupydemocrats.com/2017/09/24/dan-rather-just-gave-best-response-trumps-nfl-remarks/', 'content' : content, 'title' : title
}
data = urllib.urlencode(values)
req = urllib2.Request(url, data)
response = urllib2.urlopen(req)
the_page = response.read()
print(the_page)
