<script type="text/html" id="tmpl-tyme-set-admin-views">
  <a href="#" class="tyme-set-primary tyme-category" data-tax="{{data.taxonomy}}">
    <?php _e( 'Set Primary', 'tyme' ); ?>
  </a>
</script>
<script type="text/html" id="tmpl-tyme-unset-admin-views">
  <a href="#" class="tyme-unset-primary tyme-category" data-tax="{{data.taxonomy}}">
    <?php _e( 'Unset Primary', 'tyme' ); ?>
  </a>
</script>
<?php wp_nonce_field( 'tyme_primary_nonce', 'tyme_primary_nonce' ); ?>
