FROM php:8.2-apache

# تثبيت الإضافات المطلوبة
RUN docker-php-ext-install pdo pdo_mysql

# تشغيل rewrite module
RUN a2enmod rewrite

# نسخ الملفات
COPY . /var/www/html/

# تعديل الصلاحيات
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# فتح المنفذ
EXPOSE 80

# تشغيل Apache
CMD ["apache2-foreground"]