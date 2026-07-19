pipeline{
    agent any 

    environment {
        APP_ENV = 'testing'
    }

    stages{
    stage('Checkout') {
        steps {
            checkout scm
        }
    }
    stage('Install composer') {
        steps{
            sh 'composer install --no-interaction --prefer-dist'
        }
    }
    stage ('Prepare Environment') {
        steps{
            sh 'cp .env.testing .env'
            sh 'php artisan key:generate'
        }
    } 
    stage('Run Tests') {
        steps{
            sh 'php artisan test'
        }
    }
    }
}
post {

    success{
        echo 'All test have passed'
    }

    failure {
        echo 'Test failed'
    }
}