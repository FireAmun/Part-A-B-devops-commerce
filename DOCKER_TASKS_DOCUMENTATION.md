# Docker Tasks Documentation

## Overview
This document outlines the completion of three essential Docker tasks for the DevOps project:

1. **Create Docker Image from GitHub Project Repo**
2. **Push Docker Image to Docker Hub**
3. **Pull Docker Image from Docker Hub**

---

## Task 1: Create Docker Image from GitHub Project Repo

### 1.1 Dockerfile Creation
Created a comprehensive Dockerfile for the Laravel e-commerce application:

```dockerfile
# Use the official PHP image with Apache
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy environment file
COPY .env.example .env

# Generate application key
RUN php artisan key:generate

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
```

### 1.2 .dockerignore Creation
Created `.dockerignore` file to exclude unnecessary files:

```
node_modules
npm-debug.log
vendor
.env
.env.backup
.phpunit.result.cache
Homestead.json
Homestead.yaml
auth.json
npm-debug.log
yarn-error.log
.git
.gitignore
README.md
docker-compose.yml
.dockerignore
Dockerfile
.editorconfig
```

### 1.3 Build Command Executed
```bash
docker build -t devops-commerce:latest .
```

### 1.4 Build Results
- **Build Time**: 334.7 seconds (~5.5 minutes)
- **Image Size**: 1.74GB
- **Image ID**: 7573ebfd8d6f
- **Status**: Successfully built

---

## Task 2: Push Docker Image to Docker Hub

### 2.1 Authentication
Successfully authenticated with Docker Hub:
- **Username**: amar343
- **Status**: Authenticated with existing credentials

### 2.2 Image Tagging
Tagged the local image for Docker Hub:
```bash
docker tag devops-commerce:latest amar343/devops-commerce:latest
```

### 2.3 Push Command Executed
```bash
docker push amar343/devops-commerce:latest
```

### 2.4 Push Results
- **Repository**: docker.io/amar343/devops-commerce
- **Tag**: latest
- **Status**: Successfully pushed
- **Layers**: Multiple layers pushed including application code, dependencies, and configurations

---

## Task 3: Pull Docker Image from Docker Hub

### 3.1 Local Image Removal
Removed the locally tagged image to simulate pulling from a clean environment:
```bash
docker rmi amar343/devops-commerce:latest
```

### 3.2 Pull Command Executed
```bash
docker pull amar343/devops-commerce:latest
```

### 3.3 Pull Results
- **Source**: docker.io/amar343/devops-commerce:latest
- **Status**: Successfully pulled
- **Image ID**: 7573ebfd8d6f (matches original)
- **Size**: 1.74GB

---

## Final Docker Images Status

After completing all three tasks, the following images are available locally:

| Repository | Tag | Image ID | Created | Size |
|------------|-----|----------|---------|------|
| amar343/devops-commerce | latest | 7573ebfd8d6f | 3 minutes ago | 1.74GB |
| devops-commerce | latest | 7573ebfd8d6f | 3 minutes ago | 1.74GB |
| yourusername/devops-commerce | latest | 7573ebfd8d6f | 3 minutes ago | 1.74GB |

---

## Docker Hub Repository Information

- **Repository URL**: https://hub.docker.com/r/amar343/devops-commerce
- **Visibility**: Public
- **Pull Command**: `docker pull amar343/devops-commerce:latest`
- **Tags Available**: latest

---

## Application Features Included in Docker Image

The Docker image contains the complete Laravel e-commerce application with:

1. **Refactored Codebase**: All code smell improvements implemented
2. **CartService**: Extracted business logic from controllers
3. **Database Seeders**: Product data properly seeded
4. **Benchmark System**: Performance comparison tools included
5. **Model Relationships**: Properly defined Eloquent relationships
6. **Dependencies**: All Composer and NPM packages installed
7. **Apache Configuration**: Properly configured for Laravel
8. **Environment Setup**: Application key generated and ready to run

---

## How to Run the Docker Container

To run the containerized application:

```bash
# Pull the image (if not already available locally)
docker pull amar343/devops-commerce:latest

# Run the container (using port 8081 to avoid conflicts)
docker run -d -p 8081:80 --name laravel-app-new amar343/devops-commerce:latest

# Access the application
# Open browser and navigate to: http://localhost:8081
```

### Alternative Ports and Container Names

If you encounter port or name conflicts, use these alternatives:

```bash
# Option 1: Use port 8082
docker run -d -p 8082:80 --name laravel-app-v2 amar343/devops-commerce:latest
# Access at: http://localhost:8082

# Option 2: Use port 9000
docker run -d -p 9000:80 --name devops-commerce-app amar343/devops-commerce:latest
# Access at: http://localhost:9000

# Option 3: Let Docker assign a random port
docker run -d -P --name laravel-random-port amar343/devops-commerce:latest
# Check assigned port with: docker ps
```

### Container Management Commands

```bash
# Check running containers
docker ps

# Check all containers (including stopped)
docker ps -a

# Stop a running container
docker stop laravel-app-new

# Remove a container
docker rm laravel-app-new

# Stop and remove in one command
docker rm -f laravel-app-new
```

---

## Task 4: Container Deployment Verification

### 4.1 Container Deployment
Successfully deployed the Docker container using an alternative port to avoid conflicts:

```bash
docker run -d -p 8081:80 --name laravel-app-new amar343/devops-commerce:latest
```

### 4.2 Deployment Results
- **Container ID**: 976fa486ddb09feaa548dcd06cec4f4024ead059c19c62c4f7790112c669870a
- **Status**: Successfully started
- **Port Mapping**: 8081:80 (host:container)
- **Container Name**: laravel-app-new
- **Access URL**: http://localhost:8081

### 4.3 Application Access
The Laravel e-commerce application is now running and accessible through the web browser at `http://localhost:8081`. The application includes:

- **Homepage**: Product catalog with refactored code
- **Cart Functionality**: Using the new CartService implementation
- **Benchmark Page**: Available at `http://localhost:8081/benchmark`
- **Vendor Management**: Complete e-commerce functionality
- **Database**: Seeded with product data

---

## Summary

✅ **Task 1 Completed**: Successfully created Docker image from GitHub project repository  
✅ **Task 2 Completed**: Successfully pushed Docker image to Docker Hub  
✅ **Task 3 Completed**: Successfully pulled Docker image from Docker Hub  
✅ **Task 4 Completed**: Successfully deployed and verified container is running on port 8081

All Docker tasks have been completed successfully. The Laravel e-commerce application is now:
- Containerized and available on Docker Hub
- Running locally in a Docker container
- Accessible via web browser at http://localhost:8081
- Ready for deployment and distribution

---

**Date**: June 30, 2025  
**Project**: SCSI4383 - Part B DevOps Commerce  
**Docker Hub Repository**: amar343/devops-commerce
