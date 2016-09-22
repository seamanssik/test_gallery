$  = require 'jquery'
#_  = require 'underscore'
#Mn = require 'backbone.marionette'

window._ = require('underscore')
# Backbone can't see it otherwise
Backbone = require('backbone')
# Use the jQuery from the script tag
Backbone.$ = $
Backbone.Marionette = require('backbone.marionette')
Backbone.Marionette.$ = Backbone.$;

TodoMVC = new Backbone.Marionette.Application()

# Item view
ItemView = Backbone.Marionette.ItemView.extend(
  template: '#itemTemplate'
  tagName: 'tr')
# Collection view
CollectionView = Backbone.Marionette.CollectionView.extend(
  childView: ItemView
  tagName: 'tbody')

EmailController = showEmail: (email) ->
console.log('controller constract')

MyRouter = TodoMVC.AppRouter.extend(
  controller: EmailController
  appRoutes: 'album/:album': 'showEmail'
  onRoute: (name, path, args) ->
    console.log 'User navigated to ' + path
)

#rebindNavigation = ->
#  $('#paginationHtml A').click ->
#    $('#items tbody').remove()
#    url = $(this).attr('href')
#    loadData url
#    window.history.pushState '', '', url
#    false
#  return
#
#loadData = (url) ->
#  console.log(url)
#  $.getJSON url, (data) ->
## sample collection
#    collection = new (Backbone.Collection)(data.items)
#    view = new CollectionView(collection: collection)
#    # Render and append the view
#    $('#items').append view.render().el
#    $('#totalCount').text data.pagination.totalCount
#    $('#paginationHtml').html data.paginationHtml
#    rebindNavigation()
#
#loadData document.location.href
#
#$(window).bind 'popstate', ->
#  loadData document.location


#
#$(document).ready ->
#  console.log(6453432)


