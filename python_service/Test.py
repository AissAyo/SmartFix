import mysql.connector
from urllib.parse import urlparse, parse_qs

def connect_from_url(database_url):
    url = urlparse(database_url)
    query_params = parse_qs(url.query)

    db_config = {
        'user': url.username,
        'password': url.password,
        'host': url.hostname,
        'port': url.port,
        'database': url.path.lstrip('/'),
        'charset': query_params.get('charset', ['utf8mb4'])[0],
    }

    try:
        connection = mysql.connector.connect(**db_config)
        print("✅ Connected to the database.")
        return connection
    except mysql.connector.Error as err:
        print(f"❌ Connection error: {err}")
        return None

def list_tables(connection):
    try:
        cursor = connection.cursor()
        cursor.execute("SHOW TABLES")
        tables = cursor.fetchall()
        if tables:
            print("📋 Tables in the database:")
            for table in tables:
                print(f" - {table[0]}")
        else:
            print("ℹ️ No tables found.")
    except mysql.connector.Error as err:
        print(f"❌ Query error: {err}")
    finally:
        cursor.close()

def main():
    db_url = input("Enter your MySQL database URL: ").strip()
    conn = connect_from_url(db_url)
    if conn:
        list_tables(conn)
        conn.close()
        print("🔌 Connection closed.")

if __name__ == "__main__":
    main()
