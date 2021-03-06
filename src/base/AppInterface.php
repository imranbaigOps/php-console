<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2017-08-14
 * Time: 16:51
 */

namespace inhere\console\base;

/**
 * Interface AppInterface
 * @package inhere\console
 */
interface AppInterface
{
    // event name list
    const ON_BEFORE_RUN = 'beforeRun';
    const ON_AFTER_RUN = 'afterRun';
    const ON_RUN_ERROR = 'runError';
    const ON_BEFORE_EXEC = 'beforeExec';
    const ON_AFTER_EXEC = 'afterExec';
    const ON_EXEC_ERROR = 'execError';
    const ON_STOP_RUN = 'stopRun';
    const ON_NOT_FOUND = 'notFound';

    public function run($exit = true);
    public function stop($code = 0);

    public function controller(string $name, string $controller = null);
}