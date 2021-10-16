from django.urls import path
from .views import home, about

urlpatterns = [
    path('', home, name='home'),
    path('<int:person_id>/about/', about, name='about')
]
