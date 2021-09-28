<?php

class Api extends MY_Controller
{
    public function getNotificationAdmin()
    {
        if($_SESSION['level']=="Admin"){
            $resource = $this->db->query("SELECT * FROM notifikasi where id_user=0 and status=0 order by id desc");
        }else{
            $resource = $this->db->query("SELECT * FROM notifikasi where id_user='{$_SESSION['id']}' and status=0 order by id desc");

        }


        $data = array();
        if ($resource->num_rows() > 0) {
            foreach ($resource->result() as $rows) {
                date_default_timezone_set('Asia/Jakarta');
                $awal  = date_create($rows->created_at);
                $akhir = date_create(); // waktu sekarang
                $diff  = date_diff($awal, $akhir);
                $waktu = "";
                if ($diff->y > 0) {
                    $waktu = $diff->y . " tahun yang lalu";
                } elseif ($diff->m > 0) {
                    $waktu = $diff->m . " bulan yang lalu";
                } elseif ($diff->d > 0 && $diff->d <= 1) {
                    $waktu = "Kemarin";
                } elseif ($diff->d > 1) {
                    $waktu = $diff->d . " hari yang lalu";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h > 0) {
                    $waktu = $diff->h . " jam yang lalu";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i > 0) {
                    $waktu = $diff->i . " menit yang lalu";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s == 0) {
                    $waktu = "Baru saja";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s > 0) {
                    $waktu = $diff->s . " detik yang lalu";
                }
                $sub_array = array();
                $sub_array[] = $rows->id;
                $sub_array[] = $waktu;
                $sub_array[] = base_url() . $rows->link;
                $sub_array[] = $rows->pesan;
                $data[] = $sub_array;
            }
            echo json_encode(array(
                "total_notif" => $resource->num_rows(),
                "pesan" => "Kamu memiliki " . $resource->num_rows() . " pemberitahuan",
                "data" => $data,
            ));
        } else {
            echo json_encode(array(
                "total_notif" => $resource->num_rows(),
                "pesan" => "Kamu memiliki " . $resource->num_rows() . " pemberitahuan",
                "data" => $data,
            ));
        }
    }
    public function getNotificationUser()
    {
        $id = $_SESSION['id'];
        $resource = $this->db->query("SELECT * FROM notifikasi where id_user='$id' and status=0 order by id desc");


        $data = array();
        if ($resource->num_rows() > 0) {
            foreach ($resource->result() as $rows) {
                date_default_timezone_set('Asia/Jakarta');
                $awal  = date_create($rows->created_at);
                $akhir = date_create(); // waktu sekarang
                $diff  = date_diff($awal, $akhir);
                $waktu = "";
                if ($diff->y > 0) {
                    $waktu = $diff->y . " tahun yang lalu";
                } elseif ($diff->m > 0) {
                    $waktu = $diff->m . " bulan yang lalu";
                } elseif ($diff->d > 0 && $diff->d <= 1) {
                    $waktu = "Kemarin";
                } elseif ($diff->d > 1) {
                    $waktu = $diff->d . " hari yang lalu";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h > 0) {
                    $waktu = $diff->h . " jam yang lalu";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i > 0) {
                    $waktu = $diff->i . " menit yang lalu";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s == 0) {
                    $waktu = "Baru saja";
                } elseif ($diff->y == 0 && $diff->m == 0 && $diff->d == 0 && $diff->h == 0 && $diff->i == 0 && $diff->s > 0) {
                    $waktu = $diff->s . " detik yang lalu";
                }
                $sub_array = array();
                $sub_array[] = $rows->id;
                $sub_array[] = $waktu;
                $sub_array[] = base_url() . $rows->link;
                $sub_array[] = $rows->pesan;
                $data[] = $sub_array;
            }
            echo json_encode(array(
                "total_notif" => $resource->num_rows(),
                "pesan" => "Kamu memiliki " . $resource->num_rows() . " pemberitahuan",
                "data" => $data,
            ));
        } else {
            echo json_encode(array(
                "total_notif" => $resource->num_rows(),
                "pesan" => "Kamu memiliki " . $resource->num_rows() . " pemberitahuan",
                "data" => $data,
            ));
        }
    }

    public function updateNotif()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->update('notifikasi', array("status" => 1));
        echo json_encode(array("status" => "sukses"));
    }

    public function grafikData()
    {
        $query = $this->db->query("select
        count(*) as total,
        (
            case
                when month(created_at) = 1 then 'Jan'
                when month(created_at) = 2 then 'Feb'
                when month(created_at) = 3 then 'Mar'
                when month(created_at) = 4 then 'Apr'
                when month(created_at) = 5 then 'Mei'
                when month(created_at) = 6 then 'Jun'
                when month(created_at) = 7 then 'Jul'
                when month(created_at) = 8 then 'Ags'
                when month(created_at) = 9 then 'Sep'
                when month(created_at) = 10 then 'Okt'
                when month(created_at) = 11 then 'Nov'
                when month(created_at) = 12 then 'Des'
                ELSE ''
            end
        ) as bulan,
        status
    from
        order_pembacaan
    where
        year(created_at) = '2021'
    GROUP by
        month(created_at)
   ")->result();
        $query2 = $this->db->query("select
        count(*) as total,
        (
            case
                when month(created_at) = 1 then 'Jan'
                when month(created_at) = 2 then 'Feb'
                when month(created_at) = 3 then 'Mar'
                when month(created_at) = 4 then 'Apr'
                when month(created_at) = 5 then 'Mei'
                when month(created_at) = 6 then 'Jun'
                when month(created_at) = 7 then 'Jul'
                when month(created_at) = 8 then 'Ags'
                when month(created_at) = 9 then 'Sep'
                when month(created_at) = 10 then 'Okt'
                when month(created_at) = 11 then 'Nov'
                when month(created_at) = 12 then 'Des'
                ELSE ''
            end
        ) as bulan,
        status_revisi
    from
        order_pembacaan
    where
        year(created_at) = '2021'
    GROUP by
        month(created_at),status_revisi
   ")->result();
        $data = array();
        $data2 = array();
        foreach ($query as $rows) {
            array_push($data, array(
                "total" => (int)$rows->total,
                "bulan" => $rows->bulan,
                "status" => $rows->status,
            ));
        }
        foreach ($query2 as $rows) {
            array_push($data2, array(
                "total" => (int)$rows->total,
                "bulan" => $rows->bulan,
                "status" => $rows->status_revisi,
            ));
        }
        echo json_encode(array(
            "data1" => $data,
            "data2" => $data2
        ));
    }

    public function tentukan()
    {
        $id = $this->input->post('id');
        $row = $this->db->get_where('order_pembacaan', array('id' => $id))->row();
        $fun = $this->input->post('fun');
        $data = array(
            "id" => $id,
            "func" => $fun,
            "idClient" => $row->id_client,
            "idOrder"=>$row->id_order
        );
        echo json_encode(array(
            "data" => $data
        ));
    }


    public function fetch_user()
    {
        $starts       = $this->input->post("start");
        $length       = $this->input->post("length");
        $LIMIT        = "LIMIT $starts, $length ";
        $draw         = $this->input->post("draw");
        $search       = $this->input->post("search")["value"];
        $orders       = isset($_POST["order"]) ? $_POST["order"] : '';
        $id           = $this->input->post('id');
        $idClient     = $this->input->post('idClient');

        $where = "WHERE 1=1 AND level='Pembaca Gambar' ";
        $where2 = "WHERE 1=1 AND level='Pembaca Gambar' ";
        $result = array();
        if (isset($search)) {
            if ($search != '') {
                $where .= " AND (nama LIKE '%$search%'
	                OR username LIKE '%$search%'
	                OR password LIKE '%$search%'
	                OR level LIKE '%$search%'
	 )";
            }
        }

        if (isset($orders)) {
            if ($orders != '') {
                $order = $orders;
                $order_column = ['nama', 'username', 'password', 'level',];
                $order_clm  = $order_column[$order[0]['column']];
                $order_by   = $order[0]['dir'];
                $where .= " ORDER BY $order_clm $order_by ";
            } else {
                $where .= " ORDER BY id ASC ";
            }
        } else {
            $where .= " ORDER BY id ASC ";
        }
        if (isset($LIMIT)) {
            if ($LIMIT != '') {
                $where .= ' ' . $LIMIT;
            }
        }
        $index = 1;
        $button = "";
        $fetch = $this->db->query("SELECT * from users $where");
        $fetch2 = $this->db->query("SELECT * from users $where2");
        foreach ($fetch->result() as $rows) {
            $button1 = "<button onclick='return getUser(" . $rows->id . "," . $id . "," . $idClient . ")' class='btn btn-flat btn-xs btn-success' data-dismiss='modal' type='button'><i class='fa fa-check'></i></button>";
            date_default_timezone_set('Asia/Jakarta');
            $sub_array = array();
            $sub_array[] = $index;
            $sub_array[] = $rows->sip;
            $sub_array[] = $rows->nama;
            $sub_array[] = '<div class="table-actions">' . $button1 . '</div>';
            $result[]      = $sub_array;
            $index++;
        }
        $output = array(
            "draw"            =>     intval($this->input->post("draw")),
            "recordsFiltered" =>     $fetch2->num_rows(),
            "data"            =>     $result,

        );
        echo json_encode($output);
    }
}
