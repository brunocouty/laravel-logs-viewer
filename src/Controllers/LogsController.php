<?php

namespace BrunoCouty\LaravelViewLogs\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class LogsController extends Controller
{

    /**
     * Store the log path
     * @var string
     */
    private $logPath;
    /**
     * Define how many items we want to be visible in each page
     */
    const PER_PAGE = 15;

    /**
     * LogsController constructor.
     */
    public function __construct()
    {
        $this->logPath = storage_path('/logs');
    }

    /**
     * Load all log files that there are.
     * @return array
     */
    private function loadLogFiles()
    {
        $files = [];
        if ($handle = opendir($this->logPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $filename = explode('.', $entry);
                    if ($filename[count($filename) - 1] == 'log') {
                        $files[] = $entry;
                    }
                }
            }
            closedir($handle);
        }
        return $files;
    }

    /**
     * Load the page content.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = 0;
        if ($request->exists('page')) {
            $page = $request->get('page') - 1;
        }
        $logFiles = $this->loadLogFiles();
        $logFile = $logFiles[0];
        if ($request->exists('file')) {
            $logFile = $request->get('file');
        }
        $file = file($this->logPath . '/' . $logFile);
        $logs = [];
        $count = 0;
        foreach ($file as $line) {
            if (substr($line, 0, 1) == '[') {
                $data = explode(']', $line);
                $datetime = explode(' ', substr($data[0], 1));
                $types = explode(':', $data[1]);
                $type = explode('.', $types[0]);
                $logs[$count]['date'] = DateTime::createFromFormat('Y-m-d', $datetime[0])->format('Y-m-d');
                $logs[$count]['time'] = $datetime[1];
                $logs[$count]['env'] = $type[0];
                $logs[$count]['type'] = $type[1];
                $logs[$count]['content'] = substr($data[1], strpos($data[1], ':') + 2);
                continue;
            }
            $logs[$count]['stack_trace'][] = $line;
            if (strpos($line, '{main}') == 4) {
                $count++;
            }
        }
        $logs = array_reverse($logs);
        $collection = new Collection($logs);
        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice($page * self::PER_PAGE, self::PER_PAGE)->all();
        //Create our paginator and pass it to the view
        $logs = new LengthAwarePaginator(
            $currentPageSearchResults,
            count($collection),
            self::PER_PAGE,
            ($page + 1),
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        $fileActive = $logFile;
        return view('laravel-logs-viewer::home', compact('logFiles', 'logs', 'fileActive'));
    }

    /**
     * Download a log file.
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($file)
    {
        $file_path = $this->logPath . '/' . $file;
        $date = date('Y-m-d H:i:s');
        $file_name = $date . '-' . config('app.name') . '-' . $file;
        return response()->download($file_path, $file_name);
    }
}