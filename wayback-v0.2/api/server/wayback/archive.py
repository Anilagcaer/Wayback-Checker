import requests
import argparse
import json
import urllib3
from colorama import Fore, Back, Style

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)


"""
    def check(self):
            for i in self.urls:
                try:
                    r = requests.get(i)
                    self.checked[str(i)] = str(r.status_code)
                except:
                    self.checked[str(i)] = "Error"
"""

"""
def check(self):
        for i in self.urls:
            try:
                r = requests.get(i)
                self.checked_l.append(i + " [{}]".format(str(r.status_code)))
            except:
                self.checked_l.append(i + " [{}]".format(""))
"""

class checker:
    def __init__(self,urls):
        self.checked_d = dict()
        self.checked_l = list()
        self.checked_t = str()
        self.urls = urls

    def check(self,t:str):
        try:
            r = requests.get(t,verify=False)
            if r.status_code == 200 or 202 or 220 or 201:
                return t + " [{}]".format(Fore.CYAN + str(r.status_code) + Style.RESET_ALL)
            elif r.status_code == 404:
                return t + " [{}]".format(Fore.YELLOW + str(r.status_code) + Style.RESET_ALL)
            elif r.status_code == 400 or 401 or 403:
                return t + "[{}]".format(Fore.MAGENTA + str(r.status_code) +Style.RESET_ALL)
            elif r.status_code == 302 or 301 or 300:
                return t + "[{}]".format(Fore.LIGHTBLUE_EX + str(r.status_code) +Style.RESET_ALL)
            elif r.status_code == 500:
                return t + "[{}]".format(Fore.RED + str(r.status_code) +Style.RESET_ALL)
            else:
                return t + " [{}]".format(r.status_code)
        except:
            t + " [{}]".format("")

        
        
    def dic_to_json(self):
        file = open("out.json","w")
        file.write(json.dumps(self.checked))

class Cwayback(checker):
    def __init__(self,url:str):
        self.url = url
        self.urls = list()
        super().__init__(self.urls)
    
    def extractor(self):
        r = requests.get("http://web.archive.org/cdx/search/cdx?url={}/*&output=txt&fl=original&collapse=urlkey".format(self.url))
        for i in r.text.split("\n"):
            if i != None and i != "": 
                self.urls.append(i)