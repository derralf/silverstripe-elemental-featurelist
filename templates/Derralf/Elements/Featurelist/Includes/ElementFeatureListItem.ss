

                <div class="{$ColCss} grid-list-item">
                    <% if $ShowImage %>
                    <div class="featurelist-item-image">
                        <% if $Image %>
                            <img src="$Image.Link" alt="$Title.ATT">
                        <% else %>
                            <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                        <% end_if %>
                    </div>
                    <% end_if %>
                    <h3 class="featurelist-item-title">$Title</h3>
                    <div class="featurelist-item-content">
                        $Content
                    </div>

                    <% if $ReadMoreLink.LinkURL %>
                        <div class="element__readmorelink"><p><a href="$ReadMoreLink.LinkURL" class="{$ReadmoreLinkClass}" {$ReadMoreLink.TargetAttr} ><% if $ReadMoreLink.Title %>$ReadMoreLink.Title<% else %> mehr<% end_if %></a></p></div>
                    <% end_if %>

                </div>





    <%--<div class="{$ColCss}">--%>
        <%--<div class="card {$Style}" data-mh="card-teaser-{$TeaserHolderID}">--%>
            <%--<% if $Image && $ShowImage %>--%>
                <%--<% if $ReadMoreLink.LinkURL %><a href="$ReadMoreLink.LinkURL" title="$ReadMoreLinkTitle.ATT" {$ReadMoreLink.TargetAttr} ><% end_if %>--%>
                <%--<img width="720" height="405" class="card-img-top img-responsive forced" src="$Image.FocusFillMax(720,405).Link" alt="$Image.AltText.ATT">--%>
                <%--<% if $ReadMoreLink.LinkURL %></a><% end_if %>--%>
            <%--<% end_if %>--%>

            <%--<div class="card-block">--%>
                <%--<% if $ShowTitle && $Title %>--%>
                    <%--<{$TitleTagVariant} class="card-title">--%>
                    <%--<% if $ReadMoreLink.LinkURL %><a href="$ReadMoreLink.LinkURL" {$ReadMoreLink.TargetAttr}><% end_if %>--%>
                    <%--$Title--%>
                    <%--<% if $ReadMoreLink.LinkURL %></a><% end_if %>--%>
                <%--</{$TitleTagVariant}>--%>
                <%--<% end_if %>--%>

                <%--<% if $useSubtitle && $Subtitle %>--%>
                    <%--<h3 class="card-subtitle">$Subtitle</h3>--%>
                <%--<% end_if %>--%>

                <%--<% if $Content %>--%>
                    <%--<div class="card-text">--%>
                        <%--$Content--%>
                    <%--</div>--%>
                <%--<% end_if %>--%>

                <%--<% if $ReadMoreLink.LinkURL %>--%>
                    <%--<div class="element__readmorelink"><p><a href="$ReadMoreLink.LinkURL" class="{$ReadmoreLinkClass}" {$ReadMoreLink.TargetAttr} ><% if $ReadMoreLink.Title %>$ReadMoreLink.Title<% else %> mehr<% end_if %></a></p></div>--%>
                <%--<% end_if %>--%>
            <%--</div>--%>
        <%--</div>--%>
    <%--</div>--%>
