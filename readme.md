## RSS Reader
Simple app to consume rss feed and display the most frequent words

### Requirements
 - VM Virtualbox
 - Vagrant 
 - [Optional] Node.JS only to modify JS/CSS
 
### Installation
- Clone this repository ``git clone https://github.com/eriks-briedis/rss-reader.git rss-reader``
- Run ``vagrant up``
- Once Vagrant box is installed login with SSH ``vagrant ssh``
- Copy .env.example and rename it to .env
- Go to ``cd /var/www/rss-reader``
- Run ``composer install`` to install php dependencies
- Run db migrations ``php artisan migrate`` to create required tables
- Add ``192.168.10.10 rss-reader.local`` to your hosts file
- Open ``http://rss-reader.local`` in your browser
- JS is already compiled and commited for simplicity. ``npm install`` and ``npm run dev`` locally to recompile.
