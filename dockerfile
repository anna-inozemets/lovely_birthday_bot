# Use the official PHP image
FROM php:8.2-cli

# Set the working directory
WORKDIR /app

# Copy the entire project into the container
COPY . .

# Specify the port that Render will use (it listens to $PORT)
EXPOSE 10000

# Use the $PORT environment variable set by Render
CMD ["sh", "-c", "php -S 0.0.0.0:$PORT index.php"]
