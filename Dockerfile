# Utilise l'image officielle PHP 8.2 avec CLI
FROM php:8.2-cli

# Installe les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Optionnel : si tu veux utiliser MySQL à la place
# RUN docker-php-ext-install pdo pdo_mysql

# Crée un dossier de travail
WORKDIR /var/www/html

# Copie les fichiers de ton projet dans le conteneur
COPY . .

# Expose le port 8000 (optionnel, utile pour le serveur PHP intégré)
EXPOSE 8000

# Commande par défaut (exécute le serveur PHP intégré)
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
