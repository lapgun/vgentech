# Railway Environment Variables Setup

## Required Environment Variables

Vào Railway Dashboard → Your Project → vgentech service → **Variables** tab

Thêm các biến sau:

### Application Settings
```
APP_NAME=VGenTech
APP_ENV=production
APP_KEY=base64:1pdxiG3oxYpsTLWVB0QRNu62r8qN/Xot4DmTXuDUEQs=
APP_DEBUG=false
APP_URL=https://vgentech-production.up.railway.app
```

### Database Settings (Link với Postgres service)
```
DB_CONNECTION=pgsql
DB_HOST=${{Postgres.PGHOST}}
DB_PORT=${{Postgres.PGPORT}}
DB_DATABASE=${{Postgres.PGDATABASE}}
DB_USERNAME=${{Postgres.PGUSER}}
DB_PASSWORD=${{Postgres.PGPASSWORD}}
```

### Session & Queue
```
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Port Configuration
```
PORT=8080
```

## Sau khi thêm variables:

1. Click **Save** hoặc **Deploy** button
2. Service sẽ tự động redeploy
3. Đợi 2-3 phút để deployment hoàn tất
4. Truy cập: https://vgentech-production.up.railway.app

## Nếu vẫn lỗi 502:

1. Kiểm tra **Deployments** tab → Click vào deployment mới nhất
2. Xem **Build Logs** và **Deploy Logs**
3. Đảm bảo không có error về APP_KEY, database connection
4. Nếu có lỗi database, kiểm tra Postgres service đã link đúng chưa
