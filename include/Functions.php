<?PHP
?>
<?
$modules = [];
exec("sensors-detect --auto 2>&1|grep -Po \"^Driver.{2}\K[^\']*\"", $matches);
foreach ($matches as $module) if (exec("modprobe -D $module 2>/dev/null")) $modules[] = $module;
sort($modules);
echo implode(' ',$modules);
?>