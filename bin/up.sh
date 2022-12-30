
rsync -ahv --progress \
--exclude 'tmp/cache/*' \
--exclude 'tmp/sessions/*' \
--exclude 'tmp/tests/*' \
--exclude 'tmp/debug_kit.sqlite' \
--exclude 'tests/*' \
--exclude 'logs/*' \
../* fleuraison.sakura.ne.jp:~/www/tools.fleuraison.net/


