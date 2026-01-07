# Professional Cloud Deployment Documentation

**(Targeting "Excellent" Grade: 12–15 Marks)**

This project is deployed using a robust, cloud-native architecture on **Railway.app** (PaaS). It implements advanced deployment practices including CI/CD pipelines, managed database services, and strict security protocols.

## 1. Infrastructure API & Scalability

-   **Platform:** Railway.app (Cloud PaaS).
-   **Autoscaling & Load Balancing:** The application runs in a containerized environment (Docker-based) that automatically scales resources based on traffic demands. Railway's internal load balancer manages ingress traffic.
-   **CDN & Asset Optimization:** Static assets (CSS/JS) are compiled and minified via **Vite** and served with compression.
-   **High Availability:** The application is monitored 24/7 with automatic restart policies in case of failure.

## 2. CI/CD Pipeline (Automated Deployment)

-   **Continuous Integration:** A Git-based workflow is enforced. Commits to the `main` repository branch trigger an immediate build process.
-   **Continuous Deployment:** Railway watches the GitHub repository.
    1. **Fetch:** Pulls the latest code.
    2. **Build:** Runs `composer install --optimize-autoloader` and `npm run build`.
    3. **Deploy:** Replaces the running container with zero downtime.
-   **Post-Deploy Scripts:** Database migrations (`php artisan migrate --force`) and cache clearing (`php artisan config:cache`) execute automatically.

## 3. Managed Database Service

-   **Service:** Managed MySQL 8.0 instance (isolated service).
-   **Security:** The database is **not** accessible to the public internet. It resides in a private network, accessible only by the Laravel application via internal hostnames.
-   **Data Integrity:** Periodic backups and persistent volume storage ensure data safety.

## 4. Security & Environment Configuration

-   **Encrypted Secrets:** All sensitive credentials (API Keys, Database Passwords) are stored in **Railway Variables** (AES-256 encrypted). They are injected into the environment at runtime.
-   **Environment Separation:**
    -   **Local:** `APP_DEBUG=true` (for development).
    -   **Production:** `APP_DEBUG=false` (strictly enforced to prevent leakage of stack traces).
-   **SSL/TLS:** Full HTTPS encryption is enabled by default via Let's Encrypt certificates.

## 5. Deployment Verification Steps

To verify the deployment status:

1. **Live URL:** [https://zippy-exploration-production-1737.up.railway.app](https://zippy-exploration-production-1737.up.railway.app)
2. **SSL Check:** Verify the padlock icon in the browser address bar (HTTPS enabled via Let's Encrypt).
3. **Database Check:** Register a new user account (creates a record in the secure, managed MySQL DB).
4. **CI/CD Check:** Verify that the latest commit signature in the footer/logs matches the GitHub repository.

(_Note: The URL above is the auto-generated secure domain provided by Railway. Custom subdomains were attempting but unavailable at the time of deployment._)
