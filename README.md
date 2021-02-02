 
## Getting started

#####1)Seeding the database: 
    php artisan db:seed --class=DummySeeder


#####2)There are three roles in the system: 

    super:
        email:super@super.com
        password:supersuper
    admin:
        email:admin@admin.com
        password:adminadmin
    user:
        email:user@user.com
        password:useruser
    
#####3)Configuring email settings
a)To send users invitations or notify group members of new post we need an email address. Modify .env file and set

    MAIL_SEND=true
    
 
    
