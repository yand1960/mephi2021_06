from django.db import models
from django.utils import timezone

class Inform(models.Model):

    title = models.CharField(max_length=50)
    info = models.TextField()
    date = models.date = models.DateTimeField(default=timezone.now)


    class Meta:
        verbose_name = 'Info'
        verbose_name_plural = 'Informs'