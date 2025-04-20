import mysql.connector
from urllib.parse import urlparse, parse_qs

# Parse the database URL
database_url = "mysql://root:secret@127.0.0.1:3306/symfony?serverVersion=8.0.32&charset=utf8mb4"
url = urlparse(database_url)
query_params = parse_qs(url.query)

# Extract connection parameters
db_config = {
    'user': url.username,
    'password': url.password,
    'host': url.hostname,
    'port': url.port,
    'database': url.path.lstrip('/'),  # Remove leading '/' from database name
    'charset': query_params.get('charset', ['utf8mb4'])[0],
}

# Create the connection
try:
    connection = mysql.connector.connect(**db_config)
    print("Connected to the database successfully.")
except mysql.connector.Error as err:
    print(f"Error: {err}")
    connection = None
