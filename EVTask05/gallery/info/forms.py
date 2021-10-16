from django.forms import ModelForm
from .models import Inform

class BbForm(ModelForm):
    class Meta:
        model = Inform
        fields = ('title', 'info', 'date')
