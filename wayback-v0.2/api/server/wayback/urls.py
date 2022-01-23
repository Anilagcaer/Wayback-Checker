from django.urls import path
from wayback import views

demo = "https://web.archive.org/cdx/search/cdx?url=selcuk.edu.tr/*&output=txt&collapse=urlkey&fl=original&status=202&limit=500"

urlpatterns = [
    path('', views.index, name='index'),
    path('<url_path>/<parameters>', views.url, name='url')
]