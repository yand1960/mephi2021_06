from django.urls import path
from .views import home, about, animations, animations2

urlpatterns = [
    path('', home, name='home'),
    path('<int:person_id>/about/', about, name='about'),
    path('animations/', animations, name='animation'),
    path('animations2/', animations2, name='second'),

]
