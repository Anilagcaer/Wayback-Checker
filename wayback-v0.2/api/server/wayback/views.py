from django.shortcuts import render
from django.http import HttpResponse
import requests
import json

# Create your views here.

def index(request):
    return HttpResponse('Wayback Api')

def url(request, url_path, parameters):
    root = "https://web.archive.org/cdx/search/cdx?url=" + url_path + "/*&" + parameters
    
    urls = []
    r = requests.get(root)
    for i in r.text.split("\n"):
        if i != None and i != "": 
            urls.append(i)
    json_str = json.dumps(urls)
    return HttpResponse(json_str)