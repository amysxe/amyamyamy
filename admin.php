function videos($param1 = '', $param2 = ''){
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '8');
        /* end menu active/inactive section*/

        if ($param1 == 'add') {
            $data['imdbid']                 = $this->input->post('imdbid');
            $data['title']                  = $this->input->post('title');
            $data['description']            = $this->input->post('description');
            $actors                         = $this->input->post('actor');
            $directors                      = $this->input->post('director');
            $writers                        = $this->input->post('writer');
            $countries                      = $this->input->post('country');
            $genres                         = $this->input->post('genre');
            $video_types                    = $this->input->post('video_type');
            if($actors !='' && $actors !=NULL){
                $data['stars']              = implode(',',$actors);
            }
            if($directors !='' && $directors !=NULL){
                $data['director']           = implode(',',$directors);
            }
            if($writers !='' && $writers !=NULL){
                $data['writer']             = implode(',',$writers);
            }
            if($countries !='' && $countries !=NULL){
                $data['country']            = implode(',',$countries);
            }
            if($genres !='' && $genres !=NULL){
                $data['genre']              = implode(',',$genres);
            }
            if($video_types !='' && $video_types !=NULL){
                $data['video_type']              = implode(',',$video_types);
            }

            $data['imdb_rating']        = $this->input->post('rating');
            $data['release']            = $this->input->post('release');


            $data['runtime']            = $this->input->post('runtime');
            $data['video_quality']      = $this->input->post('video_quality');
            $data['publication']        = '0';
            if(isset($_POST['publication'])) {
                $data['publication']    = '1';
            }

            $data['enable_download']    = '0';
            if(isset($_POST['enable_download'])) {
                $data['enable_download']    = '1';
            }
            $data['focus_keyword']      = $this->input->post('focus_keyword');
            $data['meta_description']   = $this->input->post('meta_description');
            $data['tags']               = $this->input->post('tags');

            $this->db->insert('videos', $data);
            $insert_id = $this->db->insert_id();
            $slug                       = url_title($this->input->post('slug'), 'dash', TRUE);
            $slug_num                   = $this->common_model->slug_num('videos',$slug);
            if($slug_num > 0){
                $slug= $slug.'-'.$insert_id;
            }
