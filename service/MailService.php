<?php

class MailService {

    function getAdminMail($userId) {
        $query = mysql_query("select m.msg,m.date,u.firstName,u.lastName from message m,user u where m.userIdFrom=u.userId and m.userIdTo=$userId");
        return $query;
    }

}

?>
