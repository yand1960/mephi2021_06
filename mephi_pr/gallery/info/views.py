from django.shortcuts import render
from django.http import HttpResponse
from .models import Inform


def home(request):
    return render(request, 'info/homef.html')


def about(request, person_id):
    data = Inform.objects.get(id=person_id)
    return render(request, 'info/about.html', {'data' : data})
