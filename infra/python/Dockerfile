FROM python:3.11-slim

WORKDIR /app

# Add debugging
RUN apt-get update && apt-get install -y curl lsb-release

# Copy requirements first for better caching
COPY requirements.txt /app/requirements.txt
RUN ls -la /app && \
    cat /app/requirements.txt && \
    pip install --no-cache-dir -r /app/requirements.txt

# Copy the Python service files
COPY . /app/

# Command to run the FastAPI service
CMD ["uvicorn", "app:app", "--host", "0.0.0.0", "--port", "8000", "--reload"]
