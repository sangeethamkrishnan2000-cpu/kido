pipeline{
 agent any 
 stages{
    stage('Checkout') {
        steps {
            checkout scm
        }
    }
    stage('Install Dependencies') {
        steps {
            sh 'composer install --no-dev --optimize-autoloader'
        }
    }
    stage('Run Migrations'){
        steps {
            sh 'php artisan migrate --force'
        }
    }
    stage('Clear Cache') {
        steps {
            sh '''
            php artisan cache:clear
            php artisan route:cache
            php artisan view:cache
            '''
        }
    }
 }
}