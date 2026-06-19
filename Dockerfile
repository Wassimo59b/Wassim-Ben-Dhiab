FROM php:8.2-cli

# ✅ installer MySQL extension
RUN docker-php-ext-install mysqli

WORKDIR /app
COPY . /app

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080"]
