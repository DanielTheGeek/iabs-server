<div class="row containers">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-plug fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{plugins}</div>
                        <div>Plugins</div>
                    </div>
                </div>
            </div>
            <a href="plugins">
                <div class="panel-footer">
                    <span class="pull-left">View plugins</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <?php
        $markup = '';
        $tables = array_slice($tables, 0, 20);
        foreach ($tables as $table) {
            if ($table !== 'iabs_options' && $table !== 'iabs_plugins' && $table !== 'iabs_users' && $table !== 'iabs_usermeta') {
                $re_table = $this->db->escape_str(ucwords(preg_replace('#[_-]#', ' ', $table)));

                $shortened_text = ellipsize($re_table, 15, .9);
                
                $query = $this->db->query("SELECT * FROM `$table`");
                $fields = '';
                
                if ($query) {
                    $word = ($query->num_rows() > 0) ? ' entries' : ' entry';
                    $fields = $query->num_rows(). $word;
                }

                $markup = '<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">'. $fields .'</div>
                                    <div>'. $re_table .'</div>
                                </div>
                            </div>
                        </div>
                        <a href="containers/view/'.$this->db->escape_str($table).'">
                            <div class="panel-footer">
                                <span class="pull-left">View '.strtolower($shortened_text).' container</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                ';

                echo $markup;
            }
        }

        if (empty($markup)) {
            echo '<div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        No Containers Yet
                    </div>
                    <div class="panel-body">
                        <p>Some of your containers will be shown here, to see all your containers go to: <pre>Containers > All Containers</pre></p>
                    </div>
                    <div class="panel-footer">
                        <a href="containers/new" class="btn btn-primary">New container</a>
                    </div>
                </div>
            </div>';
        }
    ?>
</div>