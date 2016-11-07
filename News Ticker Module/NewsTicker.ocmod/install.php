<?xml version="1.0" encoding="utf-8"?>
<modification>
    <name>Newsticker</name>
    <version>1.0</version>
    <author>WebOCreation</author>
    <link>https://webocreation.com</link>
    <file path="admin/controller/common/column_left.php">
        <operation>
            <search><![CDATA[
            if ($this->user->hasPermission('access', 'design/layout')) {
            ]]></search>
            <add position="above"><![CDATA[
            if ($this->user->hasPermission('access', 'design/newsticker')) {
				$design[] = array(
					'name'	   => $this->language->get('text_newsticker'),
					'href'     => $this->url->link('design/newsticker', 'token=' . $this->session->data['token'], true),
					'children' => array()
				);
			}
            ]]></add>
        </operation>
    </file>
    <file path="admin/language/*/common/column_left.php">
        <operation>
            <search><![CDATA[
            $_['text_affiliate']
            ]]></search>
            <add position="above"><![CDATA[
            $_['text_newsticker']='NewsTicker';
            ]]></add>
        </operation>
    </file>
</modification>