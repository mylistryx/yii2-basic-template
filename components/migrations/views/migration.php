<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */

/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use app\components\migrations\Migration;
use app\enums\TablesEnum;

/**
* Class <?= $className . "\n" ?>
*/
class <?= $className ?> extends Migration
{
/**
* {@inheritdoc}
*/
public function safeUp(): void
{
$this->createTable(TableEnum::, [

]);
}

/**
* {@inheritdoc}
*/
public function safeDown(): void
{
$this->dropTable(TableEnum::);
}
}
