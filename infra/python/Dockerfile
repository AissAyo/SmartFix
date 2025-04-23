FROM python:3.11-slim

WORKDIR /app

# Copy requirements first for better caching
# COPY python_service/requirements.txt /app/
# RUN pip install --no-cache-dir -r requirements.txt

# Copy the Python service files
# COPY python_service/ /app/

# Command to run the FastAPI service
CMD ["uvicorn", "app:app", "--host", "0.0.0.0", "--port", "8000"]
