<?php

class ExportController extends \BaseController {


    /**
     * Get a CSV file with the total number of votes for each person
     *
     * @return mixed
     */
    public function getTop()
    {
        // get snacks
        $top = DB::table('votes')
            ->join('users', 'users.id', '=', 'votes.user_id')
            ->groupBy('votes.user_id')
            ->select('users.email', DB::raw('count(*) as total_votes'))
            ->get();

        // passing the columns which I want from the result set. Useful when we have not selected required fields
        $arrColumns = array('email', 'total_votes');

        // define the first row which will come as the first row in the csv
        $arrFirstRow = array('email', 'total votes');

        // building the options array
        $options = array(
            'columns' => $arrColumns,
            'firstRow' => $arrFirstRow,
            'headers' => array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="top_users.csv"'
            ),
        );

        return convertToCSV($top, $options);
    }

    /**
     * Export info about snacks
     *
     * @return mixed
     */
    public function getExport()
    {
        // get snacks
        $snacks = Snack::with('user', 'group', 'votes', 'votes.user')
            ->leftJoin('votes', function($join)
            {
                $join->on('snacks.id', '=', 'votes.snack_id');
            })
            ->groupBy('snacks.id')
            ->select('snacks.*')
            ->get();

        // Create strings of the people who upvotes and the people who downvoted
        $index = 0;
        foreach ($snacks as $snack) {
            $upvotes = '';
            $downvotes = '';
            foreach($snack->votes as $vote) {
                if ($vote->user == null) {
                    continue;
                }
                $parts = explode('@', $vote->user->email);
                $user = $parts[0];
                if ($vote->value == 1) {
                    $upvotes .= $user . ', ';
                } else {
                    $downvotes .= $user . ', ';
                }
            }
            // keep track of who voted up/down
            $snacks[$index]->up_people = $upvotes;
            $snacks[$index]->down_people = $downvotes;

            // keep track of sum/net votes
            $snacks[$index]->sum_votes = $snack->upvotes - $snack->downvotes;
            $snacks[$index]->total_votes = $snack->upvotes + $snack->downvotes;

            $index++;
        }

        // passing the columns which I want from the result set. Useful when we have not selected required fields
        $arrColumns = array(array('group', 'name'), 'name', 'sum_votes', 'total_votes', 'upvotes', 'downvotes', array('user', 'email'), 'up_people', 'down_people');

        // define the first row which will come as the first row in the csv
        $arrFirstRow = array('Room', 'Snack name', 'Score (Upvotes - Downvotes)', 'Total votes (upvotes + downvotes)', 'Upvotes', 'Downvotes', 'Created by', 'People who upvoted', 'People who downvoted');

        // building the options array
        $options = array(
            'columns' => $arrColumns,
            'firstRow' => $arrFirstRow,
            'headers' => array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="snack_data.csv"'
            ),
        );

        return convertToCSV($snacks, $options);
    }


}
