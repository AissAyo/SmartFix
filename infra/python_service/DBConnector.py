import mysql.connector
import os
import time

class DatabaseConnection:
    def __init__(self):
        self.connection = None
        self.max_retries = 5
        self.retry_delay = 2  # seconds

    def get_connection(self):
        if self.connection is None or not self.connection.is_connected():
            self._connect()
        return self.connection

    def _connect(self):
        retries = 0
        while retries < self.max_retries:
            try:
                self.connection = mysql.connector.connect(
                    host=os.getenv('DB_HOST', 'mysql'),
                    user=os.getenv('DB_USER', 'root'),
                    password=os.getenv('DB_PASSWORD', 'root'),
                    database=os.getenv('DB_NAME', 'smartfix')
                )
                print("Connected to the database successfully.")
                return
            except mysql.connector.Error as err:
                print(f"Error connecting to database (attempt {retries + 1}/{self.max_retries}): {err}")
                retries += 1
                if retries < self.max_retries:
                    time.sleep(self.retry_delay)
        raise Exception("Failed to connect to database after maximum retries")

    def cursor(self, **kwargs):
        conn = self.get_connection()
        return conn.cursor(**kwargs)

# Create a singleton instance
db = DatabaseConnection()
