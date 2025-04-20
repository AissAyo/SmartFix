# Use the official Mercure image as the base
FROM dunglas/mercure:v0.10.0

# Set environment variables for Mercure
ENV MERCURE_PUBLISHER_JWT_KEY='8f97443755930bbd1f06032d2a07fc185387c187c23d227b254fa6b6bf715946'
ENV MERCURE_SUBSCRIBER_JWT_KEY='8f97443755930bbd1f06032d2a07fc185387c187c23d227b254fa6b6bf715946'
ENV MERCURE_CORS_ALLOWED_ORIGINS='http://127.0.0.1:8000'
ENV MERCURE_EXTRA_DIRECTIVES='cors_origins http://127.0.0.1:8000'

# Expose the default Mercure port
EXPOSE 80

# Set up the command to run Mercure
CMD ["/usr/bin/caddy", "run", "--config", "/etc/caddy/dev.Caddyfile"]

# Healthcheck for Mercure
HEALTHCHECK CMD curl --fail http://localhost/healthz || exit 1
