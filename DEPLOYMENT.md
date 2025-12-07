# Deploying to Render with Supabase

## Prerequisites
- GitHub repository with your Laravel code
- Render account (free tier available)
- Supabase project already configured

## Deployment Steps

### 1. Push to GitHub
```bash
git add .
git commit -m "Ready for Render deployment"
git push origin main
```

### 2. Deploy on Render

#### Option A: Using render.yaml (Recommended)
1. Connect your GitHub repository to Render
2. Render will automatically detect the `render.yaml` file
3. Review and create the services

#### Option B: Manual Setup
1. Go to Render Dashboard
2. Click "New +" → "Web Service"
3. Connect your GitHub repository
4. Configure:
   - **Name**: gbookers
   - **Environment**: Docker
   - **Dockerfile Path**: ./Dockerfile
   - **Instance Type**: Free
   - **Auto-Deploy**: Yes

### 3. Environment Variables
Add these environment variables in Render dashboard:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app-name.onrender.com
SUPABASE_URL=https://qmvsxhdtvpobvyrrjxro.supabase.co
SUPABASE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InFtdnN4aGR0dnBvYnZ5cnJqeHJvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NjUxMjc4MzEsImV4cCI6MjA4MDcwMzgzMX0.ZJXmoyVVL8bV05_ThL_QRhrT8gWPcFrgn_p8dCfSxOs
DB_CONNECTION=sqlite
SESSION_DRIVER=file
CACHE_DRIVER=file
LOG_CHANNEL=errorlog
PORT=8080
```

### 4. Health Check
Render will automatically check `/` for health. Make sure your homepage loads correctly.

### 5. Access Your App
Once deployed, your app will be available at:
`https://your-app-name.onrender.com`

## Important Notes

1. **Free Plan Limitations**: 
   - Apps sleep after 15 minutes of inactivity
   - Cold starts can take 30-60 seconds
   - 750 hours/month limit

2. **Database**: Using SQLite for simplicity. For production, consider:
   - Render PostgreSQL (better for scaling)
   - Keep using Supabase as your main database

3. **SSL**: Render automatically provides SSL certificates

4. **Custom Domain**: Upgrade to paid plan for custom domains

## Testing Supabase Integration

After deployment, test your Supabase connection:
1. Visit `https://your-app-name.onrender.com/supabase`
2. Try adding, viewing, and deleting records
3. Check browser console for any errors

## Troubleshooting

### Common Issues
- **Build Failures**: Check Dockerfile and dependencies
- **Runtime Errors**: Check Render logs
- **Supabase Connection**: Verify API keys and table names
- **Permission Issues**: Ensure proper file permissions in Dockerfile

### Debug Commands
```bash
# Check logs in Render dashboard
# Test locally with same configuration
docker build -t gbookers .
docker run -p 8080:8080 gbookers
```

## Next Steps
1. Set up custom domain (paid plan)
2. Configure monitoring and alerts
3. Set up CI/CD pipeline
4. Add error tracking (Sentry, etc.)
5. Implement backup strategy
